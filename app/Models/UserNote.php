<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;

class UserNote extends Model
{
    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['user_id', 'note'];
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
    public static function saveData($data_array, $model = array())
    {
        $model = (empty($model) ? new self() : $model);
        $model->fill($data_array);
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }

    /**
     * [user description]
     * @author Akash Sharma
     * @date   2020-11-285
     * @return [type]     [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
