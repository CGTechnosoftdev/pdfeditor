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
    	return view('front.pricing.index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPaymentForm()
    {
    	$data_array['subscription_plan_arr'] = SubscriptionPlan::dataList()->pluck('name','id')->toArray();
    	$data_array['subscription_plan_type_arr'] = config('custom_config.plan_type_arr');
    	return view('front.pricing.payment-form',$data_array);
    }

    /**
     * [checkout description]
     * @author Akash Sharma
     * @date   2020-11-17
     * @param  PaymentFormRequest $request [description]
     * @return [type]                      [description]
     */
    public function checkout(PaymentFormRequest $request){
    	$user = \Auth::user();
    	$input_data = $request->input();
    	DB::beginTransaction();
    	try{
    		$general_setting = GeneralSetting::dataRow();
    		$subscription_plan = SubscriptionPlan::dataRow(['id'=>$input_data['subscription_plan_id']]);
    		if($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_MONTHLY')){
    			$input_data['amount'] = $subscription_plan['monthly_amount'];
    		}elseif($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY')){
    			$input_data['amount'] = $subscription_plan['yearly_amount'];
    		}
    		$input_data['trail_days'] = $trail_days = $general_setting->trail_days;
    		$input_data['currency'] = $general_setting->currency;
    		$payment_response = $this->chargePayment($input_data);
    		if(!empty($payment_response['success'])){
    			if(!empty($payment_response['data'])){
    				$transaction_data = [
    					'user_id' => $user->id,
    					'reference_id' => $payment_response['data']->id,
    					'amount' => $input_data['amount'],
    					'payment_log' => json_encode($payment_response['data']),
    					'payment_status' => $payment_response->status == "succeeded" ? config('constant.PAYMENT_STATUS_SUCCESS') : config('constant.PAYMENT_STATUS_FAILED'),
    				];
    				$transaction_data = Transaction::saveData($transaction_data);
    			}else{
    				$transaction_data = [];
    			} 
    			//User 
    			$user_data = [
    				'subscription_status'=> empty($trail_days) ? config('constant.SUBSCRIPTION_STATUS_YES') : config('constant.SUBSCRIPTION_STATUS_TRAIL'),
    				'subscription_plan_type' => $input_data['subscription_plan_type'],
    				'subscription_plan_id' => $input_data['subscription_plan_id'],
    				'subscription_plan_amount' => $input_data['amount'],
    			];
    			User::saveData($user_data,$user);
    			//User Subscription
    			$increase_days = empty($trail_days) ? ($input_data['subscription_plan_type'] == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY') ? 365 : 30) : $trail_days;
    			$user_subscription_data = [
    				'subscription_plan_type'=> empty($trail_days) ?  $input_data['subscription_plan_type'] : config('constant.SUBSCRIPTION_PLAN_TYPE_TRAIL'),
    				'subscription_plan_id' => $input_data['subscription_plan_id'],
    				'user_id' => $user->id,
    				'start' => date('Y-m-d H:i:s'),
    				'end' => addDaysToDate($increase_days),
    				'transaction_id' => $transaction_data['id'] ?? null,
    				'status' => config('constant.STATUS_ACTIVE')
    			];
    			UserSubscription::saveData($user_subscription_data); 	
    			DB::commit();		
    			$response_type='success';
    			$response_message="Plan subscribed successfully, Enjoy our services";
    		}else{
    			DB::rollback();
    			$response_type='error';
    			$response_message = $payment_response['message'] ?? 'Error occoured, Please try again.';
    		}
    		
    	}catch(Exception $e){
    		DB::rollback();
    		$response_type='error';
    		$response_message=$e->getMessage();
    	}
    	set_flash($response_type,$response_message,false);
    	$redirect_route = ($response_type == 'success') ? 'front.dashboard' : 'front.payment-form';
    	return redirect()->route($redirect_route);

    }
}
