<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserPromo;
use App\Traits\StripePaymentTrait;

class SubscriptionPaymentController extends FrontBaseController
{
    use StripePaymentTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!empty($user->stripe_customer_id)) {
            $card_detail = $this->getCardDetail($user->stripe_customer_id);
        }
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
            'user' => $user,
            'card_detail' => $card_detail
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

    public function view(UserSubscription $user_subscription)
    {
        if ($user_subscription->user_id != Auth::user()->id) {
            return abort(404);
        }

        $transactionFields = $user_subscription->transaction ?? null;
        //  dd($transactionFields);
        $data_array = ["title" => "Subscription Payment Detail"];
        return view('front.subscription-payment-view', $data_array);
    }

    public function cancelSubscription()
    {
        $user = Auth::user();
        $user_data = [
            'subscription_status' => config('constant.SUBSCRIPTION_STATUS_CANCELLED'),
            'subscription_plan_id' => null,
            'subscription_plan_amount' => 0.00,
            'subscription_plan_type' => null,
        ];
        $user_subscription = User::saveData($user_data, $user);
        if (!empty($user->userPromo)) {
            $user->userPromo = UserPromo::saveData(['status' => config('constant.STATUS_INACTIVE')], $user->userPromo);
        }

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

    public function updateCard(Request $request)
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
        set_flash($response_type, $response_message);
        return redirect()->route('front.subscription-payment');
    }
}
