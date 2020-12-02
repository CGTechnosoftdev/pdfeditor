<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\UserSubscription;

class SubscriptionPaymentController extends FrontBaseController
{
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

        $user_subscription_list = \DB::table('user_subscriptions')
            ->join('users', 'user_subscriptions.user_id', '=', 'users.id')
            ->select(
                'user_subscriptions.id',
                'user_subscriptions.start',
                'user_subscriptions.end',
                'user_subscriptions.subscription_plan_type',
                'users.subscription_plan_amount',
                'users.subscription_status',
                'user_subscriptions.user_id',
                'user_subscriptions.status',
            )->where("user_id", "=", "8")
            ->get()->toArray();
        $user_active_subscription = null;
        foreach ($user_subscription_list as $user_list_index => $user_Sub_ob) {
            if ($user_Sub_ob->status == config("constant.STATUS_ACTIVE"))
                $user_active_subscription = $user_Sub_ob;
        }
        $default_currency = config('constant.DEFAULT_CURRNCY');
        if ($default_currency == "USD")
            $default_currency = "$";

        if (!empty($user_active_subscription)) {
            $your_plan_amount = $default_currency . $user_active_subscription->subscription_plan_amount;
            $plan_type = "";
            switch ($user_active_subscription->subscription_plan_type) {
                case config("constant.SUBSCRIPTION_PLAN_TYPE_TRAIL"):
                    $plan_type = "Trial";
                    break;
                case config("constant.SUBSCRIPTION_PLAN_TYPE_MONTHLY"):
                    $plan_type = "Per Month";
                    break;
                case config("constant.SUBSCRIPTION_PLAN_TYPE_YEARLY"):
                    $plan_type = "Per Year";
                    break;
            }
            //subscription_status
            $subscription_status = "";
            switch ($user_active_subscription->subscription_status) {
                case config("constant.SUBSCRIPTION_STATUS_YES"):
                    $subscription_status = "Paid";
                    break;
                case config("constant.SUBSCRIPTION_STATUS_TRIAL"):
                    $subscription_status = "Trial";
                    break;
            }
            $subscribed_on = "";
            if (!empty($user_active_subscription->start))
                $subscribed_on = "Subscribed on " . date("m-d-Y", strtotime($user_active_subscription->start));
        }


        $dataArray = [
            'title' => "Subscription & Payment",
            'user_subscription_list'   => $user_subscription_list,
            'SUBSCRIPTION_STATUS_NO' => config("constant.SUBSCRIPTION_STATUS_NO"),
            'SUBSCRIPTION_STATUS_YES' => config("constant.SUBSCRIPTION_STATUS_YES"),
            'SUBSCRIPTION_STATUS_TRAIL' => config("constat.SUBSCRIPTION_STATUS_TRAIL"),
            'user_active_subscription' => $user_active_subscription,
            'your_plan_amount' => $your_plan_amount,
            'plan_type' => $plan_type,
            'DEFAULT_CURRNCY' => $default_currency,
            'subscribed_on' => $subscribed_on,
            'subscription_status' => $subscription_status,


        ];

        return view('front.subscription-payment', $dataArray);
    }
    function cancelSubscription(Request $request)
    {
        echo '<pre>';
        print_r($request);
        echo '</pre>';
        exit();
    }
}
