<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseModelTrait;

class GeneralSetting extends Model
{
    use BaseModelTrait;
	protected $fillable = ['user_id','site_title','trail_days', 'date_format' ,'time_format', 'paging_limit', 'currency', 'facebook_url', 'twitter_url', 'instagram_url' , 'linked_in_url','ios_app_url','android_app_url'];
	public $timestamps = true;

    /**
     * [saveData description]
     * @author Akash Sharma
     * @date   2020-11-06
     * @param  [type]     $dataArray [description]
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

    public static function dataRow($user_id=null){
        return self::where('user_id',$user_id)->first();
    }
}
