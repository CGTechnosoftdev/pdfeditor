<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StripePaymentTrait;

class SubscriptionPlan extends Model
{

	use SoftDeletes;
	use BaseModelTrait;
	use StripePaymentTrait;

	protected $fillable = ['name', 'slug', 'yearly_amount', 'monthly_amount', 'discount_percent', 'max_team_member', 'description', 'feature_list'];

	protected $appends = [
		'formated_monthly_amount', 'formated_yearly_amount', 'formated_discount_percent'
	];

	protected $dates = ['deleted_at'];

	public $timestamps = true;

	public function getFormatedMonthlyAmountAttribute()
	{
		return myCurrencyFormat($this->monthly_amount);
	}

	public function getFormatedYearlyAmountAttribute()
	{
		return myCurrencyFormat($this->yearly_amount);
	}

	public function getFormatedDiscountPercentAttribute()
	{
		return ($this->discount_percent ?? "0.00") . "%";
	}

	public static function saveData($dataArray, $model = array())
	{
		$model = (empty($model) ? new self() : $model);
		$model->fill($dataArray);
		if ($model->save()) {
			return $model;
		} else {
			return false;
		}
	}
	public static function cancelSubscriptionProcess($user)
	{
		$user_data = [
			'subscription_status' => config('constant.SUBSCRIPTION_STATUS_CANCELLED'),
			'subscription_plan_id' => null,
			'subscription_plan_amount' => 0.00,
			'subscription_plan_type' => null,
		];
		$user_subscription = User::saveData($user_data, $user);
		return $user_subscription;
	}
}
