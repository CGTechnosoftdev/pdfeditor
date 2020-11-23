<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\FrontResetPasswordFormRequest;
use Illuminate\Support\Facades\Password;

class FrontResetPasswordController extends Controller
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

    use ResetsPasswords{
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
    }


    public function resetPasswordFrm($token,Request $request){
        $email=$request->email;

        $tokenData = \DB::table('password_resets')
        ->where('token', $token)->first();
        if (!$tokenData) 
        {
            $response_type='error';
            $response_message='Pasword Reset link is expired,Thank You!'; 
            set_flash($response_type,$response_message,false);
         return view('auth.passwords.front-modal-message');
        } 

   
     return view('auth.passwords.front-reset',['email' => $email,'token' => $token]);
 }

 public function resetPasswordSave(FrontResetPasswordFormRequest $request){  
       $input_data=$request->input();      
         $password = $input_data["password"];     
         $tokenData = \DB::table('password_resets')
         ->where('token', $input_data["token"])->first();
         if (!$tokenData) return view('auth.passwords.email');
         $user = User::where('email', $tokenData->email)->first();
         if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
        $user->password = \Hash::make($password);
        $user->update();   
        \Auth::login($user);
        \DB::table('password_resets')->where('email', $user->email)
         ->delete();
         $response_type='success';
         $response_message='Password updated successfully,Thank You!';  
         set_flash($response_type,$response_message,false);
       return route('front.dashboard');
    }
}
