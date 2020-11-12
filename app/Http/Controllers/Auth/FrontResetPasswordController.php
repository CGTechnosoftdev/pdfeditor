<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\FrontResetPasswordFormRequest;

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
     return view('auth.passwords.front-reset',['email' => $email,'token' => $token]);
 }

 public function resetPasswordSave(FrontResetPasswordFormRequest $request){

    $validator=$request->validate($this->rules(), $this->validationErrorMessages());

         if ($validator->fails()) {
            $fieldsWithErrorMessagesArray = $validator->messages()->get('*');

             return redirect()->back()->withErrors($fieldsWithErrorMessagesArray);
         }

         $password = $request->password;
     
         $tokenData = \DB::table('password_resets')
         ->where('token', $request->token)->first();
         if (!$tokenData) return view('auth.passwords.email');

         $user = User::where('email', $tokenData->email)->first();

         if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);

         $user->password = \Hash::make($password);

         $user->update(); 
         \Auth::login($user);

         \DB::table('password_resets')->where('email', $user->email)
         ->delete();

         return redirect()->route('front.dashboard');


    }




}
