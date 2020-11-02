<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as BaseRole;

class Top100Form extends Model
{

    use SoftDeletes;
	use BaseModelTrait;

	protected $fillable = ['name','slug', 'description','lastest_version_id','relevent_keywords'];
	protected $dates = ['deleted_at'];
	public $timestamps = true;

    //
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
