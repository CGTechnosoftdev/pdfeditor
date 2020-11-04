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

    use AuthenticatesUsers{
        logout as performLogout;
    }

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
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->route('login');
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
        if($user->status == config('constant.STATUS_INACTIVE')){
            Auth::logout();
            set_flash('error', 'Your account is Inactive. Please contact to Administrator',false);
            return redirect()->route('login');
        }

        if($user->status == config('constant.STATUS_BLOCKED')){
            Auth::logout();
            set_flash('error', 'Your account is Blocked. Please contact to Administrator',false);
            return redirect()->route('login');
        }

        if($user->status ==  config('constant.STATUS_PENDING')){
            Auth::logout();
            set_flash('error', 'Your account is Pending. Please contact to Administrator',false);
            return redirect()->route('login');
        }
    }
}
