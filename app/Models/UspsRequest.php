<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class UspsRequest extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['user_id', 'from_name', 'from_address_line_first', 'from_address_line_second', 'from_city', 'from_state', 'from_zip', 'to_name', 'to_address_line_first', 'to_address_line_second', 'to_city', 'to_state', 'to_zip', 'color_mode_status', 'delivery_method', 'status'];
    protected $appends = [];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public static function saveData($dataArray, $model = array())
    {
        $model = (empty($model) ? new self() : $model);
        $model->fill($dataArray);
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }
}
