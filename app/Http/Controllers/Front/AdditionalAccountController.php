<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AdditionalUserFormRequest;
use App\Mail\CommonMail;
use Illuminate\Support\Facades\Mail;
use DB, Auth, Response, View;

class AdditionalAccountController extends FrontBaseController
{
    function __construct()
    {
    }

    public function list()
    {
        $user = Auth::user();
        if (!empty($user->parent_id)) {
            abort(404);
        }
        $data_array = [
            'title' => "Manage Additional Accounts",
        ];
        return view('front.user-account.additional-account-list', $data_array);
    }

    public function listData(Request $request)
    {
        $user = Auth::user();
        if (!empty($user->parent_id)) {
            abort(404);
        }
        $input_data = $request->input();
        $params = [];
        $params['user_id'] = $user->id;
        $params['search_text'] = $input_data['search_text'] ?? null;
        $params['order_by'] = $input_data['sort_by'] ?? null;

        $items = User::getAdditionalAccountList($params);
        $view = View::make('front.user-account.additional-account-list-item')->with('items', $items)->render();
        $count = count($items);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function createAdditionalUser(AdditionalUserFormRequest $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {
            $input_data['password'] = generateRandomString(8);
            $input_data['parent_id'] = $user->id;
            $additional_user = User::saveData($input_data);
            $additional_user->syncRoles([config('constant.USER_ROLE')]);
            if ($additional_user) {
                DB::commit();
                //Send Welcome Email
                $email_config = [
                    'config_param' => 'additional_welcome_email',
                    'content_data' => [
                        'name' => $additional_user->full_name,
                        'email' => $additional_user->email,
                        'password' => $input_data['password'],
                    ],
                ];
                Mail::to($additional_user->email)->send(new CommonMail($email_config));

                $response_type = 'success';
                $response_message = 'User account added successfully';
            } else {
                DB::rollback();
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->back();
    }

    public function additionalAccountDetail(User $additional_user)
    {
        $user = Auth::user();
        if ($additional_user->parent_id != $user->id) {
            abort(404);
        }
        $response_data = [
            'id' => $additional_user->id,
            'first_name' => $additional_user->first_name,
            'last_name' => $additional_user->last_name,
            'email' => $additional_user->email,
            'contact_number' => $additional_user->contact_number,
        ];
        return response()->json(array(
            'success' => true,
            'data' => $response_data,
        ), 200);
    }

    public function updateAdditionalUser(User $additional_user, AdditionalUserFormRequest $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {
            if ($additional_user->parent_id != $user->id) {
                DB::rollback();
                $response_type = 'error';
                $response_message = 'Invalid User, Please try again.';
            } else {
                $additional_user = User::saveData($input_data, $additional_user);
                if ($additional_user) {
                    DB::commit();
                    $response_type = 'success';
                    $response_message = 'User account update successfully';
                } else {
                    DB::rollback();
                    $response_type = 'error';
                    $response_message = 'Error occoured, Please try again.';
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $id_arr = ((!empty($input_data['items']) && is_array($input_data['items'])) ? $input_data['items'] : [($input_data['items'] ?? '')]);
        if (!empty($id_arr)) {
            User::whereIn('id', $id_arr)->where(['parent_id' => $user->id])->delete();
            $response_type = 'success';
            $response_message = 'Deleted successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Error occoured, Please try again';
        }

        if ($response_type == 'success') {
            set_flash("success", $response_message);
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }

    public function changeStatus(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $additional_user = User::where(['id' => ($input_data['item'] ?? ''), 'parent_id' => $user->id])->first();
        $status_active = config('constant.STATUS_ACTIVE');
        $status_inactive = config('constant.STATUS_INACTIVE');
        if (!empty($additional_user) && in_array($additional_user->status, [$status_active, $status_inactive])) {
            $new_status = $additional_user->status == $status_active ? $status_inactive : $status_active;
            $additional_user = User::saveData(['status' => $new_status], $additional_user);
            $response_type = 'success';
            $response_message = 'Status changed successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Error occoured, Please try again';
        }

        if ($response_type == 'success') {
            set_flash("success", $response_message);
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }
}
