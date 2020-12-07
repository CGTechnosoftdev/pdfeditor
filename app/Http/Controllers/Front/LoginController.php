<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Socialite;
use Auth;
use DB;
use App\Http\Controllers\Api\ApiBaseController;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    public $base_api_object;
    public $social_err_messages;
    public $social_validator_ob;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectToAfterLogout = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->base_api_object = new ApiBaseController();
    }



    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.front-login');
    }

    /**
     * [login description]
     * @author Akash Sharma
     * @date   2020-11-09
     * @param  Request    $request [description]
     * @return [type]              [description]
     */

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email',
        ]);
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }


        if ($this->attemptLogin($request)) {

            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            if ($request->ajax()) {
                $response_array = $this->authenticated($request, $this->guard()->user());
                return response()->json([$response_array["return_type"] => true, 'message' => $response_array["message"]]);
            } else {
                return $this->authenticated($request, $this->guard()->user())
                    ?: redirect()->intended($this->redirectPath());
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function validatSocialLoginApi(array $data)
    {

        $response_type = "success";
        $validator = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'social_name' => ['required'],
            'provider_id' => ['required'],
            'provider' => ['required'],
            'profile_picture' => [],
        ]);
        if ($validator->fails()) {

            foreach ($validator->getMessageBag()->getMessages() as $field_name => $messages) {

                $this->social_err_messages[$field_name] = $messages;
            }

            $response_type = "error";
        } else {
            $this->social_validator_ob = $validator;
        }
        return   $response_type;
    }
    protected function create(array $input_data)
    {
        return User::create([

            'first_name '           =>  $input_data["social_name"],
            'email'         => $input_data["email"],
            'profile_picture'         => (!empty($input_data["profile_picture"]) ? $input_data["profile_picture"] : ''),
            'provider_id'   => (!empty($input_data["provider_id"]) ? $input_data["provider_id"] : ''),
            'provider'      => $input_data["provider"],
        ]);
    }

    public function socialLoginApi($provider, Request $request)
    {
        $response_type = $this->validatSocialLoginApi($request->all());
        $dataArray = array();
        if ($response_type == "success") {
            $input_data = $this->social_validator_ob->validate();

            $user       =   User::where(['email' => $input_data["email"]])->first();
            if (!$user) {
                $user = User::create([
                    'social_name'           =>  $input_data["social_name"],
                    'email'         => $input_data["email"],
                    'profile_picture'         => (!empty($input_data["profile_picture"]) ? $input_data["profile_picture"] : ''),
                    'provider_id'   => (!empty($input_data["provider_id"]) ? $input_data["provider_id"] : ''),
                    'provider'      => $input_data["provider"],
                ]);
                $user->syncRoles(config('constant.USER_ROLE'));
            }
            $accessToken = $user->createToken('authToken')->accessToken;
            if (!empty($accessToken)) {
                $response_type = 'success';
                $response_message = "Login Successfully";
                $dataArray["access_token"] = $accessToken;
            }
        }

        if ($response_type == "success") {
            return    $this->base_api_object->sendSuccess($dataArray, $response_message);
        } elseif ($response_type == "error") {
            return    $this->base_api_object->sendError("Invalid Data", $this->social_err_messages);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        return redirect($this->redirectToAfterLogout);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $user_roles = $user->roles->pluck('id')->toArray();
        $dataArray["return_type"] = "success";
        $dataArray["message"] = "Login successfully!";

        if (!in_array(config('constant.USER_ROLE'), $user_roles)) {
            Auth::logout();
            $message = 'User not found!';
            $dataArray["return_type"] = "error";
            $dataArray["message"] = $message;
        }

        if ($user->status == config('constant.STATUS_INACTIVE')) {
            Auth::logout();
            $message = 'Your account is Inactive. Please contact to Administrator';
            $dataArray["return_type"] = "error";
            $dataArray["message"] = $message;
            set_flash('error', $message, false);
        }

        if ($user->status == config('constant.STATUS_BLOCKED')) {
            Auth::logout();
            $message = 'Your account is Blocked. Please contact to Administrator';
            $dataArray["return_type"] = "error";
            $dataArray["message"] = $message;
            set_flash('error', $message, false);
        }

        if ($user->status ==  config('constant.STATUS_PENDING')) {
            Auth::logout();

            $link = route('front.resend.verification.account');
            $message = "Email verification pending, If not recieve verification email <a  href='" . $link . "'>click here</a> to resend";
            set_flash('error', $message, false);
            $dataArray["return_type"] = "error";
            $dataArray["message"] = $message;
        }
        return $dataArray;
    }

    public function loginAsUser($id)
    {
        $user = User::find($id);
        $this->guard()->login($user);
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('front_web');
    }
}
