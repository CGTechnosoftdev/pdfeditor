<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use App\Traits\StripePaymentTrait;
use App\Models\SubscriptionPlan;

class SubscriptionApiController extends ApiBaseController
{
    use StripePaymentTrait;

    function cancelSubscriptionApi()
    {
        $user = \Auth::user();

        $userList = User::query()->where([['subscription_status', '=', '0'], ["id", "=", $user->id]])->get();
        if (count($userList) > 0) {
            return    $this->sendError('User Subscription already cancelled!');
        }

        $user_subscription = SubscriptionPlan::cancelSubscriptionProcess($user);

        if ($user_subscription) {
            return    $this->sendSuccess([], 'User subscription cancel successfully!');
        } else {
            return    $this->sendError('User not canelled due to technical error!');
        }
    }

    public function subscriptionHistoryApi(Request $request)
    {


        $user = \Auth::user();
        $page_not_define = config('constant.PAGE_NOT_DEFINE');
        $limit = $request->all()["limit"] ?? config('general_settings.paging_limit');
        $page = $request->all()["page"] ?? $page_not_define;

        $skip = 0;
        if (empty($page)) {
            $page = 1;
            $skip = 0;
        } else {
            $skip_multi = $page - 1;
            $skip = $limit * $skip_multi;
        }
        $date_format = config('general_settings.date_format');
        $dataArray = array();
        $recordsArray = array();
        if ($page != $page_not_define)
            $userSubscriptions = UserSubscription::query()->where("user_id", "=", $user->id)->skip($skip)->take($limit)->get();
        else
            $userSubscriptions = UserSubscription::query()->where("user_id", "=", $user->id)->get();
        if (!empty($userSubscriptions)) {
            foreach ($userSubscriptions as $index => $user_subObject) {
                $recordsArray[$user_subObject->id]["start"] = changeDateFormat($user_subObject->start, $date_format);
                $recordsArray[$user_subObject->id]["end"] = changeDateFormat($user_subObject->end, $date_format);

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
        return    $this->sendSuccess($dataArray, '');
    }

    function subscriptionPaymentMethodPostApi(Request $request)
    {
        $user = \Auth::user();

        $input_data = $request->input();
        \DB::beginTransaction();
        try {
            $card_token = $this->createCardToken($input_data);
            if (!empty($card_token['success'])) {

                $customer_update = $this->linkCardToCustomer($card_token['data']);

                if (!empty($customer_update['success'])) {
                    $response_type = 'success';
                    $response_message = 'Card update successfully';
                } else {
                    $response_type = 'error';
                    $response_message = $customer_update['message'];
                }
            } else {
                $response_type = 'error';
                $response_message = $card_token['message'];
            }
        } catch (Exception $e) {
            \DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }

        if ($response_type == "success") {
            return    $this->sendSuccess([], $response_message);
        } elseif ($response_type == "error") {
            return    $this->sendError($response_message);
        }
    }
}
