<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;

class PromoUrl extends Model
{
	use SoftDeletes;
	use BaseModelTrait;

	// protected $dateFormat = 'd-m-Y';

	protected $fillable = ['promotion_name', 'subscription_plan_id', 'trail_days', 'monthly_amount_type', 'monthly_amount', 'valid_for_months', 'yearly_amount_type', 'yearly_amount', 'valid_for_years', 'expiration_date', 'campaign_source', 'campaign_medium', 'campaign_name', 'campaign_term', 'campaign_content', 'status'];

	protected $appends = [
		'subscription_plan_name', 'formated_monthly_amount', 'formated_yearly_amount', 'promo_url'
	];

	protected $dates = ['deleted_at'];

	public $timestamps = true;

	public function getSubscriptionPlanNameAttribute()
	{
		return $this->subscription_plan->name;
	}

	// public function getMonthlyAmountAttribute(){
	// 	return ($this->monthly_amount_type == config('constant.DEFAULT_AMOUNT_TYPE')) ? $this->subscription_plan->monthly_amount : $this->monthly_amount;
	// } 

	// public function getYearlyAmountAttribute(){
	// 	return ($this->yearly_amount_type == config('constant.DEFAULT_AMOUNT_TYPE')) ? $this->subscription_plan->yearly_amount : $this->yearly_amount;
	// }

	public function getExpirationDateAttribute()
	{
		return changeDateFormat(($this->expiration_date ?? $this->attributes['expiration_date']));
	}

	public function getFormatedMonthlyAmountAttribute()
	{
		return myCurrencyFormat(($this->monthly_amount_type == config('constant.DEFAULT_AMOUNT_TYPE')) ? $this->subscription_plan->monthly_amount : $this->monthly_amount);
	}

	public function getFormatedYearlyAmountAttribute()
	{
		return myCurrencyFormat(($this->yearly_amount_type == config('constant.DEFAULT_AMOUNT_TYPE')) ? $this->subscription_plan->yearly_amount : $this->yearly_amount);
	}

	public function getPromoUrlAttribute()
	{
		$campaign_attr  = ['campaign_source', 'campaign_medium', 'campaign_name', 'campaign_term', 'campaign_content'];
		$url = \URL::to('/promo-url/' . $this->id);
		$append_arr = [];
		foreach ($campaign_attr as $attr) {
			if (!empty($this->$attr)) {
				$append_arr[] = $attr . "=" . $this->$attr;
			}
		}
		if (!empty($append_arr)) {
			$url .= "?" . implode("&", $append_arr);
		}
		return $url;
	}

	/**
	 * [saveData description]
	 * @author Akash Sharma
	 * @date   2020-10-28
	 * @param  [type]     $dataArray [description]
	 * @param  array      $model     [description]
	 * @return [type]                [description]
	 */
	public static function saveData($dataArray, $model = array())
	{
		$model = (empty($model) ? new self() : $model);
		$model->fill($dataArray);
		$model->monthly_amount = (empty($model->monthly_amount_type) ? null : $model->monthly_amount);
		$model->yearly_amount = (empty($model->yearly_amount_type) ? null : $model->yearly_amount);
		$model->expiration_date = changeDateFormat($model->expiration_date, 'db');
		if ($model->save()) {
			return $model;
		} else {
			return false;
		}
	}

	/**
	 * [ssubscription_plan description]
	 * @author Akash Sharma
	 * @date   2020-11-16
	 * @return [type]     [description]
	 */
	public function subscription_plan()
	{
		return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id', 'id');
	}
}
