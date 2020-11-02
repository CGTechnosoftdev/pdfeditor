<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{

    use SoftDeletes;
	use BaseModelTrait;

	protected $fillable = ['name','slug', 'heading' ,'short_description','description'];
	protected $dates = ['deleted_at'];
	public $timestamps = true;

    //
    public static function saveData($dataArray,$model=array())
	{ 
		$model = (empty($model) ? new self() : $model);
	//	$dataArray['guard_name'] = config('auth.defaults.guard');;
		$model->fill($dataArray);
		if($model->save()){
			return $model;
		}else{
			return false;
		}
	}
}
