<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
class ModelHasRole extends Model
{   
	
	public $timestamps = false;
	
	protected $fillable = ['role_id', 'model_type' ,'model_id'];

	protected $model_type;
	
	public function __construct()
	{
		parent::__construct();
		$this->model_type = config('constant.DEFAULT_MODEL_TYPE');
	}
	
	public function User()
	{
		return $this->belongsTo(User::class,'model_id','id');
	}

	public function Role()
	{
		return $this->belongsTo(Role::class,'role_id','id');
	}
	
	/**
	 * [saveData description]
	 * @author Akash Sharma
	 * @date   2020-10-28
	 * @param  [type]     $data_array [description]
	 * @param  [type]     $model     [description]
	 * @return [type]                [description]
	 */
	public static function saveData($data_array,$model=null)
	{ 
		$model = (empty($model) ? self::firstOrNew(['model_id'=> $data_array['model_id'],'model_type'=>$this->model_type]) : $model);
		$model->fill($data_array);
		if($model->save()){
			return $model;
		}else{
			return false;
		}
	}
	
	
}
