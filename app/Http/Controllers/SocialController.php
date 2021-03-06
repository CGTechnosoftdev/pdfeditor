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
    public function Callback($provider)
    {
        $userSocial =   Socialite::driver($provider)->stateless()->user();
        $users       =   User::where(['email' => $userSocial->getEmail()])->first();
        if($users){
            Auth::login($users);
            set_flash("success","Login Successfully",false);
            return redirect('/dashboard');
        }else{
            
                  $user = User::create([
                'first_name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'profile_picture'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
                                     ]);         
                                     $user->syncRoles(config('constant.USER_ROLE'));                        
            // return redirect()->route('dashboard');
            set_flash("success","Login Successfully",false);
            Auth::login($user);
            return redirect('/dashboard');
         }
    }
}
