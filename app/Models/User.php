<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use BaseModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id','first_name','last_name','profile_picture','gender','country_id','contact_number','email', 'password','status'
    ];

    protected $appends = [
        'full_name','profile_picture_url','gender_name','role_name','status_name'
    ];

    protected $dates = ['deleted_at'];
    public $timestamps = true;

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


    public function getFullNameAttribute(){
        return $this->first_name." ".$this->last_name;
    }    

    public function getProfilePictureUrlAttribute(){
        return  getUploadedFile($this->profile_picture,'profile_picture');
    }    

    public function getGenderNameAttribute(){
        $gender_arr = config('custom_config.gender_arr');
        return  $gender_arr[$this->gender] ?? '';
    }

    public function getRoleNameAttribute(){
        $roles = $this->getRoleNames()->toArray();
        return  (empty($roles) ? '' : (is_array($roles) ? implode(',',$roles) : $roles));
    }

    public function getStatusNameAttribute(){
        $status_arr = config('custom_config.all_status_arr');
        return  $status_arr[$this->status] ?? '';
    }


    /**
     * [saveData description]
     * @author Akash Sharma
     * @date   2020-10-28
     * @param  [type]     $data_array [description]
     * @param  array      $model      [description]
     * @return [type]                 [description]
     */
    public static function saveData($data_array,$model=array())
    { 
        $model = (empty($model) ? new self() : $model);
        if(empty($data_array['password'])){
            unset($data_array['password']);
        }else{
            $data_array['password'] = bcrypt($data_array['password']);
        }
        $model->fill($data_array);
        if($model->save()){
            return $model;
        }else{
            return false;
        }
    }

    /**
     * [modelHasRole description]
     * @author Akash Sharma
     * @date   2020-10-28
     * @return [type]     [description]
     */
    public function modelHasRole()
    {
        return $this->hasOne(ModelHasRole::class,'model_id','id');
    }
}
