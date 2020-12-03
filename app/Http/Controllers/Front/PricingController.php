<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Traits\StripePaymentTrait;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\PromoUrl;
use App\Models\UserPromo;
use App\Models\GeneralSetting;
use App\Http\Requests\PaymentFormRequest;
use DB;
use Session;
use Illuminate\Support\Facades\Crypt;

class PricingController extends FrontBaseController
{
	use StripePaymentTrait;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$data_array['subscription_plan_arr'] = SubscriptionPlan::dataList();
		$currency_arr = \Arr::pluck(config('custom_config.currency_arr'), 'symbol', 'key');
		$data_array['currency_symbol'] = $currency_arr[config('general_settings.currency')];
		$data_array['subscription_plan_type_arr'] = config('custom_config.plan_type_arr');
		$data_array['default_plan_type'] = config('constant.DEFAULT_SUBSCRIPTION_PLAN_TYPE');
		return view('front.pricing.index', $data_array);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function showPaymentForm(SubscriptionPlan $subscription_plan, Request $request)
	{
		$input_data = $request->input();
		$user = \Auth::user();
		if ($user->subscription_status != config('constant.SUBSCRIPTION_STATUS_INACTIVE')) {
			$response_type = 'success';
			$response_message = "you are already subscribed,thank you!";
			set_flash($response_type, $response_message, false);
			return redirect()->route('front.dashboard');
		}
		$promo_data = Session::get('promo_data') ?? [];
		$data_array['subscription_plan'] = $subscription_plan;
		$data_array['subscription_plan_type'] = $input_data['subscription_plan_type'] ?? 2;
		$data_array['subscription_plan_type_arr'] = config('custom_config.plan_type_arr');
		$data_array['trail_days'] = $promo_data->trail_days ?? config('general_settings.trail_days');
		$data_array['promo_data'] = $promo_data;
		return view('front.pricing.payment-form', $data_array);
	}

	/**
	 * [checkout description]
	 * @author Akash Sharma
	 * @date   2020-11-17
	 * @param  PaymentFormRequest $request [description]
	 * @return [type]                      [description]
	 */
	public function checkout(SubscriptionPlan $subscription_plan, PaymentFormRequest $request)
	{
		$user = \Auth::user();
		$input_data = $request->input();
		DB::beginTransaction();
		try {
			$promo_data = Session::get('promo_data') ?? [];
			$general_setting = GeneralSetting::dataRow();
			if ($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_MONTHLY')) {
				$input_data['amount'] = $promo_data['monthly_amount'] ?? $subscription_plan['monthly_amount'];
			} elseif ($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY')) {
				$input_data['amount'] = $promo_data['yearly_amount'] ??  $subscription_plan['yearly_amount'];
			}
			$input_data['trail_days'] = $trail_days = $promo_data['trail_days'] ?? $general_setting->trail_days;
			$input_data['currency'] = $general_setting->currency;

			$payment_response = $this->chargePayment($input_data);
			if (!empty($payment_response['success'])) {
				if (!empty($payment_response['data'])) {
					$payment_log = $payment_response['data'];
					$payment_method_type = $payment_log['payment_method_details']['type'];
					if ($payment_method_type == 'card') {
						$payment_method_detail = $payment_log['payment_method_details']['card'];
						$payment_method = ucfirst($payment_method_detail['brand']) . " XX" . $payment_method_detail['last4'];
					}
					$transaction_data = [
						'user_id' => $user->id,
						'reference_id' => $payment_response['data']->id,
						'amount' => $input_data['amount'],
						'payment_method' => $payment_method ?? null,
						'currency' => strtoupper($input_data['currency']),
						'payment_log' => json_encode($payment_log),
						'payment_status' => $payment_response['data']->status == "succeeded" ? config('constant.PAYMENT_STATUS_SUCCESS') : config('constant.PAYMENT_STATUS_FAILED'),
					];
					$transaction_data = Transaction::saveData($transaction_data);
				} else {
					$transaction_data = [];
				}
				//User 
				$user_data = [
					'subscription_status' => empty($trail_days) ? config('constant.SUBSCRIPTION_STATUS_ACTIVE') : config('constant.SUBSCRIPTION_STATUS_TRAIL'),
					'subscription_plan_type' => $input_data['subscription_plan_type'],
					'subscription_plan_id' => $subscription_plan->id,
					'subscription_plan_amount' => $input_data['amount'],
				];
				User::saveData($user_data, $user);
				//User Subscription
				$end = empty($trail_days) ? ($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY') ? addYearsToDate(1) : addMonthsToDate(1)) : addDaysToDate($trail_days);
				$user_subscription_data = [
					'subscription_plan_type' => $input_data['subscription_plan_type'],
					'subscription_plan_id' => $subscription_plan->id,
					'user_id' => $user->id,
					'start' => date('Y-m-d H:i:s'),
					'end' => $end,
					'transaction_id' => $transaction_data['id'] ?? null,
					'status' => empty($trail_days) ? config('constant.SUBSCRIPTION_STATUS_ACTIVE') : config('constant.SUBSCRIPTION_STATUS_TRAIL')
				];
				UserSubscription::saveData($user_subscription_data);
				if (!empty($promo_data)) {
					$promo_start_from = addDaysToDate($trail_days);
					$valid_till = ($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY') ? addYearsToDate($promo_data['valid_for_years'], $promo_start_from) : addMonthsToDate($promo_data['valid_for_months'], $promo_start_from));
					//User Promos
					$user_promo_data = [
						'user_id' => $user->id,
						'subscription_plan_type' => $input_data['subscription_plan_type'],
						'subscription_plan_id' => $subscription_plan->id,
						'subscription_plan_amount' => $input_data['amount'],
						'valid_till' => changeDateFormat($valid_till, 'db')
					];
					UserPromo::saveData($user_promo_data);
				}
				DB::commit();
				$response_type = 'success';
				$response_message = "Plan subscribed successfully, Enjoy our services";
			} else {
				DB::rollback();
				$response_type = 'error';
				$response_message = $payment_response['message'] ?? 'Error occoured, Please try again.';
			}
		} catch (Exception $e) {
			DB::rollback();
			$response_type = 'error';
			$response_message = $e->getMessage();
		}
		set_flash($response_type, $response_message, false);
		return ($response_type == 'success') ? redirect()->route('front.dashboard') : redirect()->route('front.payment-form', [$subscription_plan->id]);
	}

	public function promoPricing($id)
	{
		$id = decryptData($id);
		$promo_data = PromoUrl::getPromoForRedeem($id);
		Session::put('promo_data', $promo_data);

		$subscription_plan_arr = SubscriptionPlan::dataList(['id' => $promo_data['subscription_plan_id']]);
		if (count($subscription_plan_arr) == 0) {
			return abort(404);
		}
		$data_array['subscription_plan_arr'] = $subscription_plan_arr;
		$data_array['promo_data'] = $promo_data;
		$currency_arr = \Arr::pluck(config('custom_config.currency_arr'), 'symbol', 'key');
		$data_array['currency_symbol'] = $currency_arr[config('general_settings.currency')];
		$data_array['subscription_plan_type_arr'] = config('custom_config.plan_type_arr');
		$data_array['default_plan_type'] = config('constant.DEFAULT_SUBSCRIPTION_PLAN_TYPE');
		$data_array['active_plan'] = $promo_data['subscription_plan_id'];
		return view('front.pricing.index', $data_array);
	}
}
