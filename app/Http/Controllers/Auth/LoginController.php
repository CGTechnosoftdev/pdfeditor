<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
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
        if (in_array(config('constant.USER_ROLE'), $user_roles)) {
            $this->guard()->logout();
            return $this->sendFailedLoginResponse($request);
        }

        if ($user->status == config('constant.STATUS_INACTIVE')) {
            $this->guard()->logout();
            set_flash('error', 'Your account is Inactive. Please contact to Administrator', false);
            return redirect()->route('login');
        }

        if ($user->status == config('constant.STATUS_BLOCKED')) {
            $this->guard()->logout();
            set_flash('error', 'Your account is Blocked. Please contact to Administrator', false);
            return redirect()->route('login');
        }

        if ($user->status ==  config('constant.STATUS_PENDING')) {
            $this->guard()->logout();
            set_flash('error', 'Your account is Pending. Please contact to Administrator', false);
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        return redirect($this->redirectTo);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('web');
    }
}
