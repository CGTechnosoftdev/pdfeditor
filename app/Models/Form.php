<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Spatie\Permission\Models\Role as BaseRole;

class Form extends Model
{
    use SoftDeletes;
    use BaseModelTrait;
    
    protected $fillable = ['form_type' ,'type_id','name','form_file'];
	protected $dates = ['deleted_at'];
    public $timestamps = true;

    
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
