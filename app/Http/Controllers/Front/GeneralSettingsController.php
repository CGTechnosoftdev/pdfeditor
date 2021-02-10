<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Timezone;
use App\Models\GeneralSetting;
use App\Models\EmailPhoneReset;

use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;

use App\Http\Requests\GeneralSettingsEmailUpdateFormRequest;
use App\Http\Requests\GeneralSettingsPasswordUpdateFormRequest;
use App\Http\Requests\GeneralSettingsPhoneUpdateFormRequest;
use App\Http\Requests\GeneralSettingsFolderEncriptPasswordUpdateFormRequest;





class GeneralSettingsController extends FrontBaseController
{
    function __construct()
    {
    }

    public function getGeneralSettings()
    {
        $user = \Auth::user();
        $timezone_list = Timezone::getTimezoneList();
        $date_time_arr = config('custom_config.date_format_arr');
        $time_format_arr = config('custom_config.time_format_arr');
        $general_settings = GeneralSetting::where(["user_id" => $user->id])->get();
        $on_off_arr = config('custom_config.on_off_arr');
        $grant_access_arr = config('custom_config.grant_access_arr');




        //time_format_arr

        $data_array = [
            'title' => "General Settings",
            'timezone_list' => $timezone_list,
            'date_time_arr' => $date_time_arr,
            'time_format_arr' => $time_format_arr,
            'on_off_arr' => $on_off_arr,
            'grant_access_arr' => $grant_access_arr,
            'user' => $user,
            'general_settings' => (!empty($general_settings[0]) ? $general_settings[0] : []),
            'is_email_update' => false,
            'is_contact_number_update' => false,
        ];

        return view('front.user-account.general-settings', $data_array);
    }
    public function emailResetUpdateRequest($token, Request $request)
    {
        //check token is valid or not
        $EmailPhoneReset = EmailPhoneReset::where('token', $token)->get();

        if (empty($EmailPhoneReset[0])) {
            $response_type = 'error';
            $response_message = 'Pasword Reset link is expired,Thank You!';
            set_flash($response_type, $response_message, false);
            return view('auth.passwords.front-modal-message');
        }


        $user = \Auth::user();
        $timezone_list = Timezone::getTimezoneList();
        $date_time_arr = config('custom_config.date_format_arr');
        $time_format_arr = config('custom_config.time_format_arr');
        $general_settings = GeneralSetting::where(["user_id" => $user->id])->get();
        $on_off_arr = config('custom_config.on_off_arr');
        $grant_access_arr = config('custom_config.grant_access_arr');




        //time_format_arr

        $data_array = [
            'title' => "General Settings",
            'timezone_list' => $timezone_list,
            'date_time_arr' => $date_time_arr,
            'time_format_arr' => $time_format_arr,
            'on_off_arr' => $on_off_arr,
            'grant_access_arr' => $grant_access_arr,
            'user' => $user,
            'general_settings' => (!empty($general_settings[0]) ? $general_settings[0] : []),
            'is_email_update' => true,
            'is_contact_number_update' => false,
            'token' => $token,
        ];

        return view('front.user-account.general-settings', $data_array);
    }

    public function phoneResetUpdateRequest($token, Request $request)
    {
        //check token is valid or not
        $EmailPhoneReset = EmailPhoneReset::where('token', $token)->get();

        if (empty($EmailPhoneReset[0])) {
            $response_type = 'error';
            $response_message = 'Pasword Reset link is expired,Thank You!';
            set_flash($response_type, $response_message, false);
            return view('auth.passwords.front-modal-message');
        }

        $user = \Auth::user();
        $timezone_list = Timezone::getTimezoneList();
        $date_time_arr = config('custom_config.date_format_arr');
        $time_format_arr = config('custom_config.time_format_arr');
        $general_settings = GeneralSetting::where(["user_id" => $user->id])->get();
        $on_off_arr = config('custom_config.on_off_arr');
        $grant_access_arr = config('custom_config.grant_access_arr');




        //time_format_arr

        $data_array = [
            'title' => "General Settings",
            'timezone_list' => $timezone_list,
            'date_time_arr' => $date_time_arr,
            'time_format_arr' => $time_format_arr,
            'on_off_arr' => $on_off_arr,
            'grant_access_arr' => $grant_access_arr,
            'user' => $user,
            'general_settings' => (!empty($general_settings[0]) ? $general_settings[0] : []),
            'is_contact_number_update' => true,
            'is_email_update' => false,
            'token' => $token,

        ];

        return view('front.user-account.general-settings', $data_array);
    }
    public function emailResetRequest(User $user)
    {

        //generate token
        //  $passwordToken = \DB::table('email_phone_reset')->where([["users_id", '=', $user->id], ["email_phone", '=', $user->email]])->first();
        $EmailPhoneReset = EmailPhoneReset::where([["users_id", '=', $user->id], ["email_phone", '=', $user->email]])->get();

        if (!empty($EmailPhoneReset[0])) {
            $token = $EmailPhoneReset[0]->token;
        } else {
            $token = Str::random(60);
            $token = hash('sha256', $token);
            $data_array["email_phone"] = $user->email;
            $data_array["users_id"] = $user->id;
            $data_array["token"] = $token;

            EmailPhoneReset::saveData($data_array);
        }
        //send email for verification
        DB::beginTransaction();
        try {

            $link =  route('front.general-settings-email-reset-update-request', [$token]) . "/" . '?email=' . urlencode($user->email);


            if ($user) {
                DB::commit();
                $email_config = [
                    'config_param' => 'email_reset_verification',
                    'content_data' => [
                        'name' => $user->first_name,
                        'email' => $user->email,
                        'reset_button' => $link,

                    ],
                ];
                Mail::to($user->email)->send(new CommonMail($email_config));
                $response_type = 'success';
                $response_message = 'Reset Email verification email send successfully,please check your email account.';
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
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function phoneResetRequest(User $user)
    {
        //generate token
        //  $passwordToken = \DB::table('email_phone_reset')->where([["users_id", '=', $user->id], ["email_phone", '=', $user->contact_number]])->first();
        $EmailPhoneReset = EmailPhoneReset::where([["users_id", '=', $user->id], ["email_phone", '=', $user->contact_number]])->get();

        if (!empty($EmailPhoneReset[0])) {
            $token = $EmailPhoneReset[0]->token;
        } else {
            $token = Str::random(60);
            $token = hash('sha256', $token);

            $data_array["email_phone"] = $user->contact_number;
            $data_array["users_id"] = $user->id;
            $data_array["token"] = $token;

            EmailPhoneReset::saveData($data_array);

            /*  \DB::table('email_phone_reset')->insert([
                'email_phone' => $user->contact_number,
                'users_id' => $user->id,
                'token' => $token,
                'created_at' => now()
            ]);
            */
        }
        //send email for verification
        DB::beginTransaction();
        try {

            $link =  route('front.general-settings-phone-reset-update-request', [$token]) . "/" . '?email=' . urlencode($user->email);


            if ($user) {
                DB::commit();
                $email_config = [
                    'config_param' => 'phone_reset_verification',
                    'content_data' => [
                        'name' => $user->first_name,
                        'email' => $user->email,
                        'reset_button' => $link,
                    ],
                ];
                Mail::to($user->email)->send(new CommonMail($email_config));
                $response_type = 'success';
                $response_message = 'Reset Phone verification email send successfully,please check your email account.';
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
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }

    public function emailUpdate(GeneralSettingsEmailUpdateFormRequest $request)
    {
        $user = \Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {

            $update_data["email"] = $input_data["gs_email_new_email"];

            //delete the token entry
            if (!empty($input_data["email_phone_token"]))
                EmailPhoneReset::where('token', $input_data["email_phone_token"])->delete();

            $user = User::saveData($update_data, $user);

            if ($user) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'Email updated successfully';
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
    public function phoneUpdate(GeneralSettingsPhoneUpdateFormRequest $request)
    {
        $user = \Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {

            $update_data["contact_number"] = $input_data["gs_phone_new_phone"];

            //delete the token entry
            if (!empty($input_data["email_phone_token"]))
                EmailPhoneReset::where('token', $input_data["email_phone_token"])->delete();

            $user = User::saveData($update_data, $user);

            if ($user) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'Phone number updated successfully';
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
    public function passwordUpdate(GeneralSettingsPasswordUpdateFormRequest $request)
    {
        $user = \Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {


            //  $update_data["password"] = \Hash::make($input_data["gs_password_new_password"]);
            $user->password = \Hash::make($input_data["gs_password_new_password"]);
            $user->update();
            //  dd($update_data["password"]);
            //   $user = User::saveData($update_data, $user);

            if ($user) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'Password updated successfully';
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

    public function dateTimeUpdate(Request $request)
    {
        $input_data = $request->all();
        $user = \Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {

            $generalSetting = GeneralSetting::where(["user_id" => $user->id])->get();
            if (!empty($generalSetting[0])) {
                $general_set_response = GeneralSetting::saveData($input_data, $generalSetting[0]);
            } else {
                $input_data["user_id"] = $user->id;
                $general_set_response = GeneralSetting::saveData($input_data);
            }


            if ($general_set_response) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'General Setting updated successfully';
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
        // return redirect()->back();
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function grantAccessUpdate(Request $request)
    {
        $input_data = $request->all();
        // dd($input_data);
        $user = \Auth::user();
        //$input_data = $request->input();
        DB::beginTransaction();
        try {

            $generalSetting = GeneralSetting::where(["user_id" => $user->id])->get();
            if (!empty($generalSetting[0])) {
                $general_set_response = GeneralSetting::saveData($input_data, $generalSetting[0]);
            } else {
                $input_data["user_id"] = $user->id;
                $general_set_response = GeneralSetting::saveData($input_data);
            }


            if ($general_set_response) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'General settings grant access updated successfully';
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
        // return redirect()->back();
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function notificationPreferenceUpdate(Request $request)
    {
        $input_data = $request->all();

        $user = \Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {

            $generalSetting = GeneralSetting::where(["user_id" => $user->id])->get();
            if (!empty($generalSetting[0])) {
                $general_set_response = GeneralSetting::saveData($input_data, $generalSetting[0]);
            } else {
                $input_data["user_id"] = $user->id;
                $general_set_response = GeneralSetting::saveData($input_data);
            }


            if ($general_set_response) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'General settings notification updated successfully';
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
        // return redirect()->back();
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function hipaaComplianceUpdate(Request $request)
    {
        $input_data = $request->all();


        $user = \Auth::user();

        DB::beginTransaction();
        try {

            $generalSetting = GeneralSetting::where(["user_id" => $user->id])->get();
            if (!empty($generalSetting[0])) {
                $general_set_response = GeneralSetting::saveData($input_data, $generalSetting[0]);
            } else {
                $input_data["user_id"] = $user->id;
                $general_set_response = GeneralSetting::saveData($input_data);
            }


            if ($general_set_response) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'General settings hippa compliance updated successfully';
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
        // return redirect()->back();
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function encriptFolderPasswordUpdate(GeneralSettingsFolderEncriptPasswordUpdateFormRequest $request)
    {
        $user = \Auth::user();
        $input_data = $request->input();

        DB::beginTransaction();
        try {


            //  $update_data["password"] = \Hash::make($input_data["gs_password_new_password"]);
            $user->folder_encript_password = \Hash::make($input_data["folder_encript_new_password"]);
            $user->update();
            //  dd($update_data["password"]);
            //   $user = User::saveData($update_data, $user);

            if ($user) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'Password updated successfully';
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
}
