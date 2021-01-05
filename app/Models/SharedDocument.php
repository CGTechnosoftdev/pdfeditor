<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class SharedDocument extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['user_id', 'share_method', 'share_type', 'link', 'security_method', 'authentication_method', 'access_privileges', 'personalize_invitation_data', 'business_card_data', 'document_notification', 'reminder_duration', 'reminder_repeat'];
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
