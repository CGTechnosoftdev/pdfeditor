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


class FrontUserRegistrationController extends Controller
{
	function __construct()
	{
	}

	public function registerUserFrm()
	{

		return view('auth.front-user-registration');
	}
	public function validator(array $data)
	{
		return Validator::make($data, [

			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8'],
		]);
	}
	public function newUserVerification($token, FrontUserRegistrationFormRequest $request)
	{
		$email = $request->email;

		$tokenData = \DB::table('password_resets')
			->where('token', $token)->first();
		if (!$tokenData) {
			$response_type = 'error';
			$response_message = 'Invalid operation!';
		} else {
			$user = User::where('email', $email)->first();
			\DB::table('password_resets')->where('email', $user->email)
				->delete();
			$user->status = 1;
			$user->save();

			if (!$user) {
				$response_type = 'error';
				$response_message = 'Email not found!';
			} else {
				$response_type = 'success';
				$response_message = 'User is activated,Thank You!';
			}
		}
		$data_array = [
			'title' => 'Email Verification',
			'heading' => 'Email Verification',
			'page_content' => "Thank you for verification process!",
		];
		set_flash($response_type, $response_message, false);
		return view('auth.front-email-verification', $data_array);
	}

	public function registerUserSave(FrontUserRegistrationFormRequest $request)
	{
		DB::beginTransaction();
		try {
			$input_data = $this->validator($request->all())->validate();
			$input_data["status"] = 0;
			event(new Registered($user = $this->create($input_data)));


			$user->syncRoles(config('constant.USER_ROLE'));


			$token = Str::random(60);
			$token = hash('sha256', $token);
			$link = route('user.verification.save', [$token]) . '/' .  '?email=' . urlencode($user->email);

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
				$response_message = 'User Registration complete successfully';
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

		$arr[$response_type] = $response_message;
		return Response()->json($arr);
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
