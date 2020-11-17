<?php
namespace App\Traits;
use Auth;

trait BaseModelTrait {

	/**
	 * [boot description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @return [type]     [description]
	 */
	public static function bootBaseModelTrait()
	{
		$table_name = self::getTableName();
		$ignore_tables = ['transactions','general_settings'];
		if(!in_array($table_name, $ignore_tables)){
			$prefix_name = request()->route()->getPrefix();
			$guard_name = Auth::getDefaultDriver();
			if($prefix_name == "/admin"){
				$guard_name = 'web';
			}
			$user = Auth::guard($guard_name)->user();
			static::creating(function($model) use ($user)
			{                       
				$model->created_by = $user->id ?? 0;
				$model->updated_by = $user->id ?? 0;
			});
			static::updating(function($model) use ($user)
			{
				$model->updated_by = $user->id ?? 0;
			});       
		}
	}

	/**
	 * [getTableName description]
	 * @author Akash Sharma
	 * @date   2020-11-17
	 * @return [type]     [description]
	 */
	public static function getTableName()
	{
		return (new self())->getTable();
	}


    /**
     * [createdByUser description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @return [type]     [description]
     */
    public function createdByUser()
    {
    	return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * [updatedByUser description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @return [type]     [description]
     */
    public function updatedByUser()
    {
    	return $this->belongsTo(User::class, 'updated_by', 'id');
    }


    /**
     * [getFormatedCreatedAt description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @return [type]     [description]
     */
    public function getFormatedCreatedAt()
    {
    	return changeDateTimeFormat($this->attributes['created_at']);
    }

    /**
     * [getFormatedUpdatedAt description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @return [type]     [description]
     */
    public function getFormatedUpdatedAt()
    {
    	return changeDateTimeFormat($this->attributes['updated_at']);
    }

    /**
     * [dataList description]
     * @author Akash Sharma
     * @date   2020-11-12
     * @param  array      $condition [description]
     * @return [type]                [description]
     */
    public static function dataList($condition = array())
    {
    	$model = self::where('status',config('constant.STATUS_ACTIVE'));
    	if(!empty($condition)){
    		$model->where($condition);
    	}
    	return $model->get();                
    }

   /**
    * [dataRow description]
    * @author Akash Sharma
    * @date   2020-11-12
    * @return [type]     [description]
    */
   public static function dataRow()
   {
   	$model = self::where('status',config('constant.STATUS_ACTIVE'));
   	if(!empty($condition)){
   		$model->where($condition);
   	}
   	return $model->first();                
   }

}