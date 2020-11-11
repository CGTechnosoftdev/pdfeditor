<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use DB;
use App\Models\User;
use Illuminate\Http\Request;


class FrontForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function forgotpassword()
    {
        return view('auth.passwords.front-email');
    }
    public function resetPassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
      ]);
         

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please enter valid email address!']);
        }

        $user = \DB::table('users')->where('email', '=', $request->email)->first();//Check if the user exists
        //dd($user);
        //model_has_roles
   
    
            if (!isset($user)) {
                return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
            }

            $modeInRole=\DB::table('model_has_roles')->where("model_id",'=',$user->id)->first();
            $role=\DB::table('roles')->where([["id",'=',$modeInRole->role_id],["name",'<>','user']])->first();
            if(!empty($role))
            {
                return redirect()->back()->withErrors(['error' => trans('User not allow to change password!')]);
    
            }

     
            \DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => preg_replace("/\//","P",str_random(60)),
                'created_at' => now()
            ]);

            $tokenDatas = \DB::table('password_resets')
                ->where('email', $request->email)->get();
                foreach($tokenDatas as $tok_index => $okenOb)
                $tokenData=$okenOb;



            if ($this->sendResetEmail($request->email, $tokenData->token)) {
                $response_type='success';
                $response_message='A reset link has been sent to your email address.';
                set_flash($response_type,$response_message);
                return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
            } else {
                $response_type='error';
                $response_message='A Network Error occurred. Please try again.';
                set_flash($response_type,$response_message);
                return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
            }

    }


    private function sendResetEmail($email, $token)
    {
        $user = \DB::table('users')->where('email', $email)->select('first_name', 'email')->first();//Generate, the password reset link. The token generated is embedded in the link$link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);

        $link = config('base_url') . 'user-reset-password/' . $token . '?email=' . urlencode($user->email);

        try {

            $email_config = [
                'config_param' => 'reset_password',
                'content_data' => [
                    'name' => $user->first_name,
                    'email' =>$user->email,
                    'reset_button' => $link,
                ],
            ];
            Mail::to($user->email)->send(new CommonMail($email_config));

        } catch (\Exception $e) {
            return false;
        }
    }


   

}
