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
        $user = Auth::user();
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = UserSubscription::query()->where(['user_id' => $user->id])->get();
            $table = Datatables()->of($model);

            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                return "<i class='fa fa-eye'></i>";
            });
            return $table->make(true);
        }
        $data_array = [
            'title' => 'Subscription & Payment',
            'heading' => 'Manage Business Category',
            'user' => $user
        ];

        $user_promo = $user->userPromo;
        if (!empty($user->lastSubscriptionDetail)) {
            $data_array['current_plan_data'] = [
                'plan_amount' => $user->plan_amount,
                'plan_name' => $user->plan_name,
                'plan_expiry' => $user->plan_expiry,
                'plan_status' => $user->lastSubscriptionDetail->status_name,
                'plan_class' => array_key_exists($user->subscription_status, config('custom_config.active_subscription_status_arr')) ? 'plan-paid' : 'account-expired',
            ];
        }
        if (array_key_exists($user->subscription_status, config('custom_config.active_subscription_status_arr'))) {
            $data_array['renewal_data'] = [
                'plan_name' => $user->getUpcomingRenewalPlan(),
                'plan_amount' => $user->getUpcomingRenewalAmount(),
                'renewal_date' => $user->plan_expiry,
            ];
        }

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

    function cancelSubscription()
    {
        $user = Auth::user();
        $user_data = [
            'subscription_status' => config('constant.SUBSCRIPTION_STATUS_CANCELLED'),
            'subscription_plan_id' => null,
            'subscription_plan_amount' => 0.00,
            'subscription_plan_type' => null,
        ];
        $user_subscription = User::saveData($user_data, $user);

        if ($user_subscription) {
            $response_type = 'success';
            $response_message = 'User added successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Error occoured, Please try again.';
        }
        set_flash($response_type, $response_message);
        return redirect()->route('front.subscription-payment');
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
