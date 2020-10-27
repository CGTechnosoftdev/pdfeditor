<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{   	
	use SoftDeletes;
	use BaseModelTrait;

	protected $fillable = ['name', 'guard_name' ,'status'];
	protected $dates = ['deleted_at'];
	public $timestamps = true;

	/**
	 * [saveData description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @param  [type]     $dataArray [description]
	 * @param  array      $model     [description]
	 * @return [type]                [description]
	 */
	public static function saveData($dataArray,$model=array())
	{ 
		$model = (empty($model) ? new self() : $model);
		$dataArray['guard_name'] = config('auth.defaults.guard');;
		$model->fill($dataArray);
		if($model->save()){
			return $model;
		}else{
			return false;
		}
	}
	
	/**
	 * [list description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @return [type]     [description]
	 */
	public static function list()
	{
		$list = self::where('status',config('constant.STATUS_ACTIVE'))
		->where('id','!=',2)
		->orderBy('name','asc')
		->pluck('name','id')
		->toArray();
		return $list;                
	}
}
