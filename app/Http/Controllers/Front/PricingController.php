<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Traits\StripePaymentTrait;
use App\Models\SubscriptionPlan;
use App\Http\Requests\PaymentFormRequest;

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

    public function checkout(PaymentFormRequest $request){
        dd($request->input());
    }
}
