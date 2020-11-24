<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

use Illuminate\Http\Request;
use App\Http\Requests\FrontUserRegistrationFormRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use DB;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\ApiBaseController;


class FrontUserRegistrationController extends Controller
{
	protected $base_api_object;
	function __construct()
	{
		$this->base_api_object = new ApiBaseController();
	}

	public function registerUserFrm()
	{

		return view('auth.front-user-registration');
	}
	public function validator(array $data)
	{
		return Validator::make($data, [

			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'regex:' . config('constant.PASSWORD_REGEX')],
		]);
	}
	public function newUserVerification($token, FrontUserRegistrationFormRequest $request)
	{
		$email = $request->email;

		$token_data = \DB::table('password_resets')->where('token', $token)->first();
		if (!$token_data) {
			$response_type = 'error';
			$response_message = 'Invalid operation!';
		} else {
			$user = User::where('email', $email)->first();
			if (empty($user) || $token_data->email != $user->email) {
				$response_type = 'error';
				$response_message = 'User not found!';
			} else {
				$user->status = config('constant.STATUS_ACTIVE');
				$user->email_verified_at = now();
				$user->save();
				\DB::table('password_resets')->where('token', $token)->delete();
				$response_type = 'success';
				$response_message = 'Email verified successfully, You can login now!';
			}
		}
		$data_array = [
			'title' => 'Email Verification',
			'heading' => 'Email Verification',
			'page_content' => "Thank you for verification process!",
			'verification_status' => $response_type,
			'verification_message' => $response_message
		];
		return view('auth.front-email-verification', $data_array);
	}

	protected function userRegisterProcess(FrontUserRegistrationFormRequest $request)
	{

		DB::beginTransaction();
		try {
			$input_data = $this->validator($request->all())->validate();
			$input_data["status"] = 0;
			event(new Registered($user = $this->create($input_data)));


			$user->syncRoles(config('constant.USER_ROLE'));


			$token = Str::random(60);
			$token = hash('sha256', $token);
			$link = route('front.user.verification.save', [$token]) . '/' .  '?email=' . urlencode($user->email);

			\DB::table('password_resets')->insert([
				'email' => $request->email,
				'token' => $token,
				'created_at' => now()
			]);


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
				$response_message = 'Registration completed, Please check your registered email for email verification';
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
		$message_data_array[$response_type] = $response_message;
		return $message_data_array;
	}

	public function registerUserSave(FrontUserRegistrationFormRequest $request)
	{
		$message_data_array = $this->userRegisterProcess($request);
		return Response()->json($message_data_array);
	}

	public function registerUserSaveApi(FrontUserRegistrationFormRequest $request)
	{
		$message_data_array = $this->userRegisterProcess($request);
		list($message_type, $message) = each($message_data_array);
		if ($message_type == "success") {
			return	$this->base_api_object->sendSuccess([], $message);
		} elseif ($message_type == "error") {
			return	$this->base_api_object->sendError($message);
		}
	}

	protected function create(array $data)
	{
		return User::create([

			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'status' => $data["status"],
		]);
	}
}
