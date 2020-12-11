<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Models\User;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function Callback($provider, Request $request)
    {
        $process_type = "web";
        if (!empty($request->process_type)) {
            if ($request->process_type == "api")
                $process_type = "api";
        }
        $userSocial =   Socialite::driver($provider)->stateless()->user();
        $users       =   User::where(['email' => $userSocial->getEmail()])->first();
        if ($users) {
            Auth::login($users);
            if ($process_type == "web") {
                set_flash("success", "Login Successfully", false);
                return redirect('/dashboard');
            }
        } else {
            $user = User::create([
                'social_name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'profile_picture'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
            ]);
            $user->syncRoles(config('constant.USER_ROLE'));

            Auth::login($user);
            if ($process_type == "web") {
                set_flash("success", "Login Successfully", false);
                return redirect('/dashboard');
            }
        }

        if ($process_type == "api") {
            if ($msg_data_array["status"] == "success") {
                return    $this->base_api_object->sendSuccess([], $msg_data_array["message"]);
            } elseif ($msg_data_array["status"] == "error") {
                return    $this->base_api_object->sendError($msg_data_array["message"]);
            }
        }
    }
}
