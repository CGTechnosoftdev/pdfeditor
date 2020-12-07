<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSubscription;
use App\Models\Transaction;
use App\Traits\StripePaymentTrait;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use Exception;
use Log;

class HomeController extends FrontBaseController
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
        return view('front.front-home');
    }

    public function renewSubscriptions()
    {
        $date = date("Y-m-d");
        $renewal_user_list = User::renewalList($date);
        $currency = config('general_settings.currency');
        foreach ($renewal_user_list as $user) {
            \DB::beginTransaction();
            try {
                $mail_content = [
                    'name' => $user->full_name,
                    'email' => $user->email,
                ];
                if (!empty($user->userPromo) && $user->userPromo->valid_till >= $date) {
                    $renewal_amount = $user->userPromo->subscription_plan_amount;
                    $renewal_plan_id = $user->userPromo->subscription_plan_id;
                    $renewal_plan_type = $user->userPromo->subscription_plan_type;
                } else {
                    $renewal_amount = $user->subscription_plan_amount;
                    $renewal_plan_type = $user->subscription_plan_type;
                }
                if (empty($user->stripe_customer_id)) {
                    $mail_content['reason'] = 'Invalid payment method';
                    $payment_failed = true;
                } else {
                    $payment_data = ['amount' => $renewal_amount, 'currency' => $currency];
                    $payment_response = $this->chargePayment($payment_data, $user);
                    if (empty($payment_response['status'])) {
                        $mail_content['reason'] = $payment_response['message'];
                        $payment_failed = true;
                    }
                }
                if (empty($payment_failed)) {
                    Log::alert("Payment failed of user " . $user->email);
                    Log::info($payment_response);
                    $email_config = [
                        'config_param' => 'renewal_failed',
                        'content_data' => $mail_content,
                    ];
                    Mail::to($user->email)->send(new CommonMail($email_config));
                } else {
                    Log::alert("Payment success of user " . $user->email);
                    Log::info($payment_response);
                    $payment_log = $payment_response['data'];
                    $start = addDaysToDate(1, $date);
                    $end = ($renewal_plan_type == config('constant.SUBSCRIPTION_PLAN_TYPE_YEARLY') ? addYearsToDate(1, $start) : addMonthsToDate(1, $start));

                    $payment_method_type = $payment_log['payment_method_details']['type'];
                    if ($payment_method_type == 'card') {
                        $payment_method_detail = $payment_log['payment_method_details']['card'];
                        $payment_method = ucfirst($payment_method_detail['brand']) . " XX" . $payment_method_detail['last4'];
                    }
                    $transaction_data = [
                        'user_id' => $user->id,
                        'reference_id' => $payment_response['data']->id,
                        'amount' => $renewal_amount,
                        'payment_method' => $payment_method ?? null,
                        'currency' => strtoupper($currency),
                        'payment_log' => json_encode($payment_log),
                        'payment_status' => config('constant.PAYMENT_STATUS_SUCCESS'),
                    ];
                    $transaction_data = Transaction::saveData($transaction_data);
                    $user_subscription_data = [
                        'subscription_plan_type' => $renewal_plan_type,
                        'subscription_plan_id' => $renewal_plan_id,
                        'user_id' => $user->id,
                        'start' => $start,
                        'end' => $end,
                        'transaction_id' => $transaction_data['id'],
                        'status' => config('constant.SUBSCRIPTION_STATUS_ACTIVE')
                    ];
                    UserSubscription::saveData($user_subscription_data);
                    \DB::commit();
                    $mail_content['duration'] = "from " . changeDateFormat($start) . " to " . changeDateFormat($end);
                    $mail_content['amount'] = myCurrencyFormat($renewal_amount);
                    $email_config = [
                        'config_param' => 'renewal_success',
                        'content_data' => $mail_content,
                    ];
                    Mail::to($user->email)->send(new CommonMail($email_config));
                }
            } catch (Exception $e) {
                \DB::rollback();
                Log::error("Payment success of user " . $user->email);
                Log::info($e->getMessage());
            }
        }
    }
}
