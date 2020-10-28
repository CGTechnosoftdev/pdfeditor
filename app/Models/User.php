<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'email', 'password','first_name','last_name','gender','contact_number','country_id','profile_picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    	'email_verified_at' => 'datetime',
    ];

    /**
     * [saveData description]
     * @author Akash Sharma
     * @date   2020-10-28
     * @param  [type]     $dataArray [description]
     * @param  array      $user      [description]
     * @return [type]                [description]
     */
    public static function saveData($dataArray,$user=array()){
    	$user = (empty($user) ? new self() : $user);
    	(!empty($dataArray['password']) ? $dataArray['password'] = bcrypt($dataArray['password']) : '');
    	$user->fill($dataArray);
    	if($user->save()){
    		return $user;
    	}else{
    		return false;
    	}
    }
}
