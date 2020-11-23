<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Traits\StripePaymentTrait;
use App\Models\SubscriptionPlan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\GeneralSetting;
use App\Http\Requests\PaymentFormRequest;
use DB;
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
		if($user->subscription_status != config('constant.SUBSCRIPTION_STATUS_NO') )
		{
			$response_type='success';
			$response_message="you are already subscribed,thank you!";
			set_flash($response_type,$response_message,false);
			return redirect()->route('front.dashboard');
		}
		$data_array['subscription_plan'] = $subscription_plan;
		$data_array['subscription_plan_type'] = $input_data['subscription_plan_type'] ?? 2;
		$data_array['subscription_plan_type_arr'] = config('custom_config.plan_type_arr');
		$data_array['trail_days'] = config('general_settings.trail_days');
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
			$general_setting = GeneralSetting::dataRow();
			if ($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_MONTHLY')) {
				$input_data['amount'] = $subscription_plan['monthly_amount'];
			} elseif ($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY')) {
				$input_data['amount'] = $subscription_plan['yearly_amount'];
			}
			$input_data['trail_days'] = $trail_days = $general_setting->trail_days;
			$input_data['currency'] = $general_setting->currency;
			$payment_response = $this->chargePayment($input_data);
			if (!empty($payment_response['success'])) {
				if (!empty($payment_response['data'])) {
					$transaction_data = [
						'user_id' => $user->id,
						'reference_id' => $payment_response['data']->id,
						'amount' => $input_data['amount'],
						'payment_log' => json_encode($payment_response['data']),
						'payment_status' => $payment_response['data']->status == "succeeded" ? config('constant.PAYMENT_STATUS_SUCCESS') : config('constant.PAYMENT_STATUS_FAILED'),
					];
					$transaction_data = Transaction::saveData($transaction_data);
				} else {
					$transaction_data = [];
				}
				//User 
				$user_data = [
					'subscription_status' => empty($trail_days) ? config('constant.SUBSCRIPTION_STATUS_YES') : config('constant.SUBSCRIPTION_STATUS_TRAIL'),
					'subscription_plan_type' => $input_data['subscription_plan_type'],
					'subscription_plan_id' => $subscription_plan->id,
					'subscription_plan_amount' => $input_data['amount'],
				];
				User::saveData($user_data, $user);
				//User Subscription
				$increase_days = empty($trail_days) ? ($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY') ? 365 : 30) : $trail_days;
				$user_subscription_data = [
					'subscription_plan_type' => empty($trail_days) ?  $input_data['subscription_plan_type'] : config('constant.SUBSCRIPTION_PLAN_TYPE_TRAIL'),
					'subscription_plan_id' => $subscription_plan->id,
					'user_id' => $user->id,
					'start' => date('Y-m-d H:i:s'),
					'end' => addDaysToDate($increase_days),
					'transaction_id' => $transaction_data['id'] ?? null,
					'status' => config('constant.STATUS_ACTIVE')
				];
				UserSubscription::saveData($user_subscription_data);
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
}
