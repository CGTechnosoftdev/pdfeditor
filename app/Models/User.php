<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use App\Models\UserSubscription;
use App\Models\UspsRequest;
use App\Models\UserDocument;
use League\OAuth2\Server\Exception\OAuthServerException;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    use SoftDeletes;
    use BaseModelTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'first_name', 'last_name', 'profile_picture', 'gender', 'country_id', 'contact_number', 'email', 'password', 'status', 'image', 'provider', 'provider_id', 'subscription_status', 'subscription_plan_id', 'subscription_plan_amount', 'subscription_plan_type', 'stripe_customer_id',
        'fax_number', 'company_name', 'company_job_title', 'countries_id', 'state', 'city', 'address_line_1', 'address_line_2', 'zip_code'

    ];

    protected $appends = [
        'full_name', 'profile_picture_url', 'gender_name', 'role_name', 'status_name', 'general_setting', 'plan_name', 'plan_expiry', 'plan_amount', 'subscription_status_name'
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

    public function userSubscription()
    {
        return $this->hasMany(UserSubscription::class, "user_id", "id");
    }


    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getProfilePictureUrlAttribute()
    {
        $url = parse_url($this->profile_picture);
        $picture_url = "";
        if (!empty($url['scheme']) && ($url['scheme'] == 'https' || $url['scheme'] == "http")) {
            $picture_url = $this->profile_picture;
        } else {
            $picture_url = getUploadedFile($this->profile_picture, 'profile_picture');
        }

        return  $picture_url;
    }

    public function getGenderNameAttribute()
    {
        $gender_arr = config('custom_config.gender_arr');
        return  $gender_arr[$this->gender] ?? '';
    }

    public function getRoleNameAttribute()
    {
        $roles = $this->getRoleNames()->toArray();
        return (empty($roles) ? '' : (is_array($roles) ? implode(',', $roles) : $roles));
    }

    public function getStatusNameAttribute()
    {
        $status_arr = config('custom_config.all_status_arr');
        return  $status_arr[$this->status] ?? '';
    }

    public function getGeneralSettingAttribute()
    {
        $user_id = (in_array(config('constant.USER_ROLE'), $this->roles->pluck('id')->toArray())) ? $this->id : NULL;
        return GeneralSetting::dataRow($user_id);
    }

    public function getPlanNameAttribute()
    {
        return $this->lastSubscriptionDetail->plan_name ?? '';
    }
    public function getPlanExpiryAttribute()
    {
        return $this->lastSubscriptionDetail->plan_expiry ?? '';
    }
    public function getPlanAmountAttribute()
    {
        return $this->lastSubscriptionDetail->plan_amount ?? '';
    }

    public function getSubscriptionStatusNameAttribute()
    {
        return $this->lastSubscriptionDetail->status_name ?? 'Inactive';
    }

    public function getUpcomingRenewalPlan()
    {
        if (!empty($this->subscriptionPlan)) {
            $plan_type_arr = config('custom_config.plan_type_arr');
            return $this->subscriptionPlan->name . " (" . $plan_type_arr[$this->subscription_plan_type] . ")";
        }
    }

    public function getUpcomingRenewalAmount()
    {
        return myCurrencyFormat($this->userPromo->subscription_plan_amount ?? $this->subscription_plan_amount);
    }

    public function getInitials()
    {
        $return = '';
        //The strtoupper() function converts a string to uppercase.
        $name  = strtoupper($this->full_name);
        if (!empty($name)) {

            //prefixes that needs to be removed from the name
            $remove = ['.', 'MRS', 'MISS', 'MS', 'MASTER', 'DR', 'MR'];
            $nameWithoutPrefix = str_replace($remove, " ", $name);

            $words = explode(" ", $nameWithoutPrefix);

            //this will give you the first word of the $words array , which is the first name
            $firtsName = reset($words);

            //this will give you the last word of the $words array , which is the last name
            $lastName  = end($words);

            $return = substr($firtsName, 0, 1) . substr($lastName, 0, 1);
        }
        return $return;
    }



    /**
     * [saveData description]
     * @author Akash Sharma
     * @date   2020-10-28
     * @param  [type]     $data_array [description]
     * @param  array      $model      [description]
     * @return [type]                 [description]
     */
    public static function saveData($data_array, $model = array())
    {
        $model = (empty($model) ? new self() : $model);
        if (empty($data_array['password'])) {
            unset($data_array['password']);
        } else {
            $data_array['password'] = bcrypt($data_array['password']);
        }
        $model->fill($data_array);
        if ($model->save()) {
            return $model;
        } else {
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
        return $this->hasOne(ModelHasRole::class, 'model_id', 'id');
    }

    /**
     * [notes description]
     * @author Akash Sharma
     * @date   2020-11-285
     * @return [type]     [description]
     */
    public function notes()
    {
        return $this->hasMany(UserNote::class, 'user_id', 'id');
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id', 'id');
    }

    public function userPromo()
    {
        return $this->hasOne(UserPromo::class, 'user_id', 'id')->where(['status' => config('constant.STATUS_ACTIVE')]);
    }

    public function lastSubscriptionDetail()
    {
        return $this->hasOne(UserSubscription::class, 'user_id', 'id')->latest();
    }

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\User
     */
    public function findForPassport($username)
    {
        $user = $this->where('email', $username)->first();
        $user_roles = $user->roles->pluck('id')->toArray();
        if (!in_array(config('constant.USER_ROLE'), $user_roles)) {
            return false;
        }
        if ($user->status == config('constant.STATUS_INACTIVE')) {
            throw new OAuthServerException('Your account is Inactive. Please contact to Administrator', 6, 'account_inactive', 401);
        }

        if ($user->status == config('constant.STATUS_BLOCKED')) {
            throw new OAuthServerException('Your account is Blocked. Please contact to Administrator', 6, 'account_blocked', 401);
        }

        if ($user->status ==  config('constant.STATUS_PENDING')) {
            throw new OAuthServerException('Your account is Pending. Please contact to Administrator', 6, 'account_pending', 401);
        }

        return $user;
    }

    public static function renewalList($date)
    {
        $active_subscription_status = array_keys(config('custom_config.active_subscription_status_arr'));
        $model = self::with('lastSubscriptionDetail', 'userPromo')
            ->whereIn('subscription_status', $active_subscription_status)
            ->where('status', config('constant.STATUS_ACTIVE'));
        $model->whereHas('lastSubscriptionDetail', function ($q) use ($date) {
            $q->where(\DB::raw('DATE(end)'), $date);
        });
        return $model->get();
    }

    public static function getAdditionalAccountList($data_array)
    {
        $condition = ['parent_id' => $data_array['user_id']];
        $model = self::query()->whereIn('status', [config('constant.STATUS_ACTIVE'), config('constant.STATUS_INACTIVE')]);
        if (!empty($condition)) {
            $model->where($condition);
        }
        if (!empty($data_array['search_text'])) {
            $model->where(function ($subQuery) use ($data_array) {
                $subQuery->where('first_name', 'like', '%' . $data_array['search_text'] . '%');
                $subQuery->orWhere('last_name', 'like', '%' . $data_array['search_text'] . '%');
                $subQuery->orWhere('email', 'like', '%' . $data_array['search_text'] . '%');
                $subQuery->orWhere('contact_number', 'like', '%' . $data_array['search_text'] . '%');
            });
        }
        $model->orderBy(($data_array['order_by'] ?? 'updated_at'), 'DESC');
        if (!empty($data_array['limit'])) {
            $model->limit($data_array['limit']);
        }
        return $model->get();
    }
    public function uspsRequests()
    {
        return $this->hasMany(UspsRequest::class, "user_id", "id");
    }
    public function userDocuments()
    {
        return $this->hasMany(UserDocument::class, "user_id", "id");
    }
}
