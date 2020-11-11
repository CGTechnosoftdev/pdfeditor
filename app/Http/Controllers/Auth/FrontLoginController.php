<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;


class FrontLoginController extends Controller
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('guest')->except('logout');
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
    public function login(Request $request){
     
    	$this->validateLogin($request);
    	// If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
    	if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
    		$this->fireLockoutEvent($request);
    		return $this->sendLockoutResponse($request);
    	}


    	if ($this->attemptLogin($request)) {
    		return $this->sendLoginResponse($request);
    	}

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
    	$this->incrementLoginAttempts($request);
    	
    	return $this->sendFailedLoginResponse($request);
    }
    
    public function logout(Request $request)
    {
    	$this->guard()->logout();
    	return redirect($this->redirectTo);
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
    	if(!in_array(config('constant.USER_ROLE'),$user_roles)){
    		Auth::logout();
    		return $this->sendFailedLoginResponse($request);
    	}

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
