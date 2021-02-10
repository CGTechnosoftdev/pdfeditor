<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{

    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['description', 'type', 'ip_address'];

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
    public static function getAuditTrail($data_array)
    {
        $condition = ['created_by' => $data_array['users_id'], 'status' => config('constant.STATUS_ACTIVE')];
        $model = self::query();

        if (!empty($condition)) {
            $model->where($condition);
        }


        if (!empty($data_array['search_text'])) {
            $date_split_array = preg_split("/\-/", $data_array['search_text']);
            $model->whereBetween('created_at', [date("Y-m-d", strtotime($date_split_array[0])), date("Y-m-d", strtotime($date_split_array[1]))]);
            //  $model->where('name', 'like', '%' . $data_array['search_text'] . '%');
        }

        if (!empty($data_array['limit'])) {
            $model->limit($data_array['limit']);
        }
        $model->orderBy('created_at', 'desc');
        echo '<br> date-0' . strtotime($date_split_array[0] . " 00:00:00");
        echo '<br/> date-1 ' . strtotime($date_split_array[1] . " 24:00:00");
        echo $model->toSql();
        exit();
        return $model->get();
    }
}
