<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Api\ApiBaseController;

class SubscriptionPaymentController extends FrontBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware('auth');
        $this->base_api_object = new ApiBaseController();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = UserSubscription::query()->where("user_id", "=", Auth::user()->id)->get();
            if (!empty($model)) {
                foreach ($model as $mod_index => $modelObject) {
                    $modelObject->start = $modelObject->start;
                }
            }

            $table = Datatables()->of($model);

            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'view' => ['route_url' => 'front.subscription-payment.view', 'route_param' => [$row->id], 'permission' => 'subscription-payment-view'],

                ];
                return view($action_button_template, compact('buttons'));
            });




            return $table->make(true);
        }

        $subscription_user = UserSubscription::query()->where("user_id", "=", Auth::user()->id)->orderBy('id', 'DESC')->first();
        $subscription_amount = "";
        $subscription_period = "";
        $upcomming_renewel = "";
        $renewel_price = "";
        if ($subscription_user->subscription_plan_type == config("constant.SUBSCRIPTION_PLAN_TYPE_TRAIL")) {
            $subscription_amount = "Trial";
        } elseif ($subscription_user->subscription_plan_type == config("constant.SUBSCRIPTION_PLAN_TYPE_MONTHLY")) {
            $subscription_amount = $subscription_user->transaction->amount;
            $renewel_price = $subscription_user->transaction->amount;
            $upcomming_renewel = changeDateFormat($subscription_user->end, "M d,Y");
            $subscription_period = "Per Month";
        } elseif ($subscription_user->subscription_plan_type == config("constant.SUBSCRIPTION_PLAN_TYPE_YEARLY")) {
            $subscription_amount = $subscription_user->transaction->amount;
            $renewel_price = $subscription_user->transaction->amount;
            $subscription_period = "Per Year";

            $upcomming_renewel = changeDateFormat($subscription_user->end, "M d,Y");
        }
        $user_current_subscribe_id = $subscription_user->id;

        $cancel_subscription_message = "";
        if ($subscription_user->user->subscription_status == config("constant.SUBSCRIPTION_STATUS_NO")) {

            $cancel_subscription_message = "Subscription Cancelled";
        }
        $current_status = "";
        $account_expired = "plan-paid";
        $subscription_status_arr = config("custom_config.subscription_status_arr");

        if (!empty($subscription_user->status)) {
            $current_status = $subscription_status_arr[$subscription_user->status];
        }

        if ($subscription_user->status == config("constant.SUBSCRIPTION_STATUS_EXPIRED")) {

            $account_expired = "account-expired";
        }
        $expireDate = "Expire On " . changeDateFormat($subscription_user->end, "M d,Y");

        $data_array = [
            'title' => 'Subscription Payment',
            'heading' => 'Manage Business Category',
            'subscription_amount' => myCurrencyFormat($subscription_amount),
            'subscription_period' => $subscription_period,
            'plan_name' => $subscription_user->SubscriptionPlan->name,
            'upcomming_renewel' => $upcomming_renewel,
            'renewel_price' => myCurrencyFormat($renewel_price),
            'user_current_subscribe_id' => $user_current_subscribe_id,
            'user_id' => $subscription_user->user_id,
            'cancel_subscription_message' => $cancel_subscription_message,
            'expireDate' => $expireDate,
            'current_status' => $current_status,
            'account_expired' => $account_expired,

        ];

        $data_array['data_table'] = [
            'data_source' => route('front.subscription-payment'),
            'data_column_config' => config('datatable_column.subscription-payment'),
        ];
        return view('front.subscription-payment', $data_array);
    }
    function view(UserSubscription $user_subscription)
    {
        if ($user_subscription->user_id != Auth::user()->id) {
            return abort(404);
        }

        $transactionFields = $user_subscription->transaction ?? null;
        //  dd($transactionFields);
        $data_array = ["title" => "Subscription Payment Detail"];
        return view('front.subscription-payment-view', $data_array);
    }
    function cancelsubscriptionProcess($user)
    {


        $data_array = [
            'subscription_status' => 0,
            'subscription_plan_id' => null,
            'subscription_plan_amount' => 0.00,
            'subscription_plan_type' => null,
        ];

        $user_subscription = User::saveData($data_array, $user);
        return $user_subscription;
    }
    function cancelSubscription(Request $request, User $user)
    {
        $userList = User::query()->where([['subscription_status', '=', '0'], ["id", "=", $user->id]])->get();
        if (count($userList) > 0) {
            echo 'User Subscription already cancelled!';
        }

        $user_subscription = $this->cancelsubscriptionProcess($user);

        if ($user_subscription) {
            echo '<br> User Subscription cancel successfully!';
        } else {
            echo '<br> user not canelled!';
        }
    }

    function cancelSubscriptionApi(Request $request, User $user)
    {
        $userList = User::query()->where([['subscription_status', '=', '0'], ["id", "=", $user->id]])->get();
        if (count($userList) > 0) {
            return    $this->base_api_object->sendError('User Subscription already cancelled!');
        }

        $user_subscription = $this->cancelsubscriptionProcess($user);
        if ($user_subscription) {
            return    $this->base_api_object->sendSuccess([], 'User subscription cancel successfully!');
        } else {
            return    $this->base_api_object->sendError('User not canelled due to technical error!');
        }
    }

    public function subscriptionHistoryApi(Request $request, User $user)
    {



        $limit = $request->all()["limit"] ?? 2;
        $page = $request->all()["page"] ?? -1;

        $skip = 0;
        if (empty($page)) {
            $page = 1;
            $skip = 0;
        } else {
            $skip_multi = $page - 1;
            $skip = $limit * $skip_multi;
        }
        $dataArray = array();
        $recordsArray = array();
        if ($page != -1)
            $userSubscriptions = UserSubscription::query()->where("user_id", "=", $user->id)->skip($skip)->take($limit)->get();
        else
            $userSubscriptions = UserSubscription::query()->where("user_id", "=", $user->id)->get();
        if (!empty($userSubscriptions)) {

            foreach ($userSubscriptions as $index => $user_subObject) {
                $recordsArray[$user_subObject->id]["start"] = changeDateFormat($user_subObject->start, "M d,Y");
                $recordsArray[$user_subObject->id]["end"] = changeDateFormat($user_subObject->end, "M d,Y");

                $myAmount = 0.00;
                if (!empty($user_subObject->transaction->amount)) {
                    $myAmount = myCurrencyFormat($user_subObject->transaction->amount);
                }
                $recordsArray[$user_subObject->id]["amount"] = $myAmount;

                $status = null;
                if (!empty($user_subObject->transaction_id)) {
                    if ($user_subObject->transaction->payment_status == config("constant.PAYMENT_STATUS_PENDING"))
                        $status = "Pending";
                    elseif ($user_subObject->transaction->payment_status == config("constant.PAYMENT_STATUS_SUCCESS"))
                        $status = "Success";
                    elseif ($user_subObject->transaction->payment_status == config("constant.PAYMENT_STATUS_FAILED"))
                        $status = "Fail";
                }
                $recordsArray[$user_subObject->id]["status"] = $status;
            }
            $NoOrRecordsResults = UserSubscription::query()->where("user_id", "=", $user->id)->get();
            $no_of_records = count($NoOrRecordsResults);

            $dataArray = [
                "data" => $recordsArray,
                "no_of_records" => $no_of_records,
            ];
        }
        return    $this->base_api_object->sendSuccess($dataArray, '');
    }
}
