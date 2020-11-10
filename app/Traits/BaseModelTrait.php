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

}