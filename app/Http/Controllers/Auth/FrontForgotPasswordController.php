<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\FrontForgotPasswordFormRequest;
use Illuminate\Support\Facades\Password;


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
        //$dataArray["action"]="front.resetpassword.email";
        return view('auth.passwords.front-email');
    }
    public function reSendVerificationAccount()
    {
        $dataArray["action"] = "front.resend.verification.account.submit";
        // return view('auth.passwords.front-email-verification-form',$dataArray);
        return view('front.partials.front-resend-verification', $dataArray);
    }
    public function reSendVerificaitonAccountSubmit(FrontForgotPasswordFormRequest $request)
    {
        $input_data = $request->input();

        $credentails = $this->credentials($request);
        $user = $this->broker()->getUser($credentails);
          if($user->status==0)
          {
                if (!isset($user)) {
                    // return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
                    $arr["error"] = "User does not exist";
                    $arr["status"] = false;
                    return Response()->json($arr);
                }
                $userRole = config('constant.USER_ROLE');


                $modeInRole = \DB::table('model_has_roles')->where("model_id", '=', $user->id)->first();

                if ($modeInRole->role_id != $userRole) {
                    $arr["error"] = "User not allow to verify your account!";
                    $arr["status"] = false;
                    return Response()->json($arr);
                }


                //generate token

                $passwordToken = \DB::table('password_resets')->where("email", '=', $user->email)->first();

                if (!empty($passwordToken)) {
                    $token = $passwordToken->token;
                } else {
                    $token = Str::random(60);
                    $token = hash('sha256', $token);
                    \DB::table('password_resets')->insert([
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => now()
                    ]);
                }
                //send email for verification
                DB::beginTransaction();
                try {


                    $link =  route('front.user.verification.save', [$token]) . "/" . '?email=' . urlencode($user->email);


                    if ($user) {
                        DB::commit();
                        $email_config = [
                            'config_param' => 'email_verification',
                            'content_data' => [
                                'name' => $user->first_name,
                                'email' => $user->email,
                                'link' => $link,
                            ],
                        ];
                        Mail::to($user->email)->send(new CommonMail($email_config));
                        $response_type = 'success';
                        $response_message = 'Email verification email send successfully,please check your email account.';
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
            }
            else{
                $response_type = 'error';
                $response_message = 'Your account is already verfied, Thank You!';
            }     

        $arr[$response_type] = $response_message;
        return Response()->json($arr);
    }
    protected function credentials(Request $request)
    {
        return $request->only('email');
    }
    public function broker()
    {
        return Password::broker();
    }

    public function resetPassword(FrontForgotPasswordFormRequest $request)
    {
        $input_data = $request->input();
        $credentails = $this->credentials($request);

        $user = $this->broker()->getUser($credentails);




        if (!isset($user)) {
            // return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
            $arr["error"] = "User does not exist";
            $arr["status"] = false;
            return Response()->json($arr);
        }
        $userRole = config('constant.USER_ROLE');

        $modeInRole = \DB::table('model_has_roles')->where("model_id", '=', $user->id)->first();

        if ($modeInRole->role_id != $userRole) {
            $arr["error"] = "User not allow to change password!";
            $arr["status"] = false;
            return Response()->json($arr);
        }

        $passwordToken = \DB::table('password_resets')->where("email", '=', $user->email)->first();

        if (!empty($passwordToken)) {
            $token = $passwordToken->token;
        } else {
            $token = Str::random(60);
            $token = hash('sha256', $token);
            \DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]);
        }


        $this->sendResetEmail($request->email, $token);
        $arr["status"] = true;
        $response_type = 'success';
        $response_message = 'A reset link has been sent to your email address.';

        /* if ($this->sendResetEmail($request->email, $token)) {

            $arr["status"] = true;
            $response_type = 'success';
            $response_message = 'A reset link has been sent to your email address.';
        } else {

            $arr["status"] = false;
            $response_type = 'error';
            $response_message = 'A Network Error occurred. Please try again.';
        } */
        $arr[$response_type] = $response_message;
        return Response()->json($arr);
    }





    private function sendResetEmail($email, $token)
    {
        $user = \DB::table('users')->where('email', $email)->select('first_name', 'email')->first(); //Generate, the password reset link. The token generated is embedded in the link$link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);

        $link = config('base_url') . 'user-reset-password/' . $token . '?email=' . urlencode($user->email);

        try {

            $email_config = [
                'config_param' => 'reset_password',
                'content_data' => [
                    'name' => $user->first_name,
                    'email' => $user->email,
                    'reset_button' => $link,
                ],
            ];
            Mail::to($user->email)->send(new CommonMail($email_config));
        } catch (\Exception $e) {
            return false;
        }
    }
}
