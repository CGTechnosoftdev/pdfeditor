<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\FrontResetPasswordFormRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Support\Facades\Validator;



class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    protected $base_api_object;
    use ResetsPasswords {
        rules as presetRules;
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->base_api_object = new ApiBaseController();
    }


    public function resetPasswordFrm($token, Request $request)
    {
        $email = $request->email;
        $tokenData = \DB::table('password_resets')
            ->where('token', $token)->first();
        if (!$tokenData) {
            $response_type = 'error';
            $response_message = 'Pasword Reset link is expired,Thank You!';
            set_flash($response_type, $response_message, false);
            return view('auth.passwords.front-modal-message');
        }
        return view('auth.passwords.front-reset', ['email' => $email, 'token' => $token]);
    }
    public function validator(array $data, $rules = [])
    {

        return Validator::make($data, $rules);
    }

    protected function resetPasswordProcess($input_data, $process_type = 'web')
    {
        // $input_data = $request->input();


        $password = $input_data["password"];
        $tokenData = \DB::table('password_resets')
            ->where('token', $input_data["token"])->first();
        if (!$tokenData) {
            if ($process_type == "web")
                return view('auth.passwords.email');
            elseif ($process_type == "api") {
                $msg_data_array = [
                    'status' => "error",
                    'message' => "Not valid operation"
                ];
                return $msg_data_array;
            }
        }

        $user = User::where('email', $tokenData->email)->first();
        if (!$user) {
            if ($process_type == "web")
                return redirect()->back()->withErrors(['email' => 'Email not found']);
            elseif ($process_type == "api") {
                $msg_data_array = [
                    'status' => "error",
                    'message' => "Email not found!"
                ];
                return $msg_data_array;
            }
        }

        $user->password = \Hash::make($password);
        $user->update();
        \Auth::login($user);
        \DB::table('password_resets')->where('email', $user->email)
            ->delete();
        $response_type = 'success';
        $response_message = 'Password updated successfully,Thank You!';
        $msg_data_array = [
            'status' => $response_type,
            'message' => $response_message,
        ];
        return $msg_data_array;
    }

    public function resetPasswordSave(FrontResetPasswordFormRequest $request)
    {
        $input_data = $this->validator($request->all(), $request->rules())->validate();

        $msg_data_array = $this->resetPasswordProcess($input_data);
        set_flash($msg_data_array["status"], $msg_data_array["message"], false);
        return route('front.dashboard');
    }

    public function resetPasswordSaveApi(FrontResetPasswordFormRequest $request)
    {
        $input_data = $this->validator($request->all(), $request->rules())->validate();
        $message_data_array = $this->resetPasswordProcess($input_data, "api");
        $message_type = $message_data_array["status"];
        $message = $message_data_array["message"];
        if ($message_type == "success") {
            return    $this->base_api_object->sendSuccess([], $message);
        } elseif ($message_type == "error") {
            return    $this->base_api_object->sendError($message, $error_messages);
        }
    }
}
