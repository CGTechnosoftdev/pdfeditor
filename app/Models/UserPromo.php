<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseModelTrait;

class UserPromo extends Model
{
    use BaseModelTrait;
    protected $fillable = ['subscription_plan_amount', 'subscription_plan_id', 'subscription_plan_type', 'user_id', 'promo_url_id', 'valid_till', 'status'];


    public function promoUrl()
    {
        return $this->belongsTo(PromoUrl::class, 'promo_url_id', 'id')->withTrashed();
    }

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
