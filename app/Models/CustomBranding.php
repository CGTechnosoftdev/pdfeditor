<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class CustomBranding extends Model
{

    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['template_style', 'company_logo', 'signature', 'users_id', 'is_use_email_template'];

    protected $dates = ['deleted_at'];
    public $timestamps = true;


    public static function saveData($dataArray, $model = array())
    {
        $model = (empty($model) ? new self() : $model);
        //	$dataArray['guard_name'] = config('auth.defaults.guard');;
        $model->fill($dataArray);
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }
}
