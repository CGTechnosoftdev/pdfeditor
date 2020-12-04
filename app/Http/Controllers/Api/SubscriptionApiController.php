<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionApiController extends ApiBaseController
{
    function cancelSubscriptionApi(User $user)
    {

        $userList = User::query()->where([['subscription_status', '=', '0'], ["id", "=", $user->id]])->get();
        if (count($userList) > 0) {
            return    $this->sendError('User Subscription already cancelled!');
        }
        $user_data = [
            'subscription_status' => config('constant.SUBSCRIPTION_STATUS_CANCELLED'),
            'subscription_plan_id' => null,
            'subscription_plan_amount' => 0.00,
            'subscription_plan_type' => null,
        ];
        $user_subscription = User::saveData($user_data, $user);

        if ($user_subscription) {
            return    $this->sendSuccess([], 'User subscription cancel successfully!');
        } else {
            return    $this->sendError('User not canelled due to technical error!');
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
        return    $this->sendSuccess($dataArray, '');
    }
}
