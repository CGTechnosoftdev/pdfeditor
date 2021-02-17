<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class UspsMailStatus extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['mail_status', 'description', 'usps_requests_id'];
    protected $appends = [];
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    public $table = 'usps_mail_status';

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
