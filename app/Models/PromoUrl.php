<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;

class PromoUrl extends Model
{   	
	use SoftDeletes;
	use BaseModelTrait;

	protected $fillable = ['promotion_name', 'subscription_plan_id', 'trail_days', 'monthly_amount', 'monthly_validity', 'yearly_amount', 'yearly_validity', 'expiry_date','status'];
	protected $dates = ['deleted_at'];
	public $timestamps = true;

	/**
	 * [saveData description]
	 * @author Akash Sharma
	 * @date   2020-10-28
	 * @param  [type]     $dataArray [description]
	 * @param  array      $model     [description]
	 * @return [type]                [description]
	 */
	public static function saveData($dataArray,$model=array()){
		$model = (empty($model) ? new self() : $model);
		$model->fill($dataArray);
		if($model->save()){
			return $model;
		}else{
			return false;
		}
	}
}
