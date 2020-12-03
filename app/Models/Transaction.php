<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseModelTrait;

class Transaction extends Model
{
    use BaseModelTrait;
    protected $fillable = ['user_id', 'reference_id', 'amount', 'payment_log', 'payment_status'];

    /**
     * [saveData description]
     * @author Akash Sharma
     * @date   2020-11-06
     * @param  [type]     $dataArray [description]
     * @return [type]                [description]
     */
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
