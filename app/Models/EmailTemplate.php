<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;

class EmailTemplate extends Model
{   	
	use SoftDeletes;
	use BaseModelTrait;

	protected $fillable = ['title','subject','content','status'];
	protected $dates = ['deleted_at'];
	public $timestamps = true;

	/**
	 * [saveData description]
	 * @author Akash Sharma
	 * @date   2020-11-17
	 * @param  [type]     $dataArray [description]
	 * @param  array      $model     [description]
	 * @return [type]                [description]
	 */
	public static function saveData($dataArray,$model=array())
	{ 
		$model = (empty($model) ? new self() : $model);
		$model->fill($dataArray);
		if($model->save()){
			return $model;
		}else{
			return false;
		}
	}
}
