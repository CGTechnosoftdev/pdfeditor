<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;
use DB;

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
            $model->whereBetween('created_at', ["STR_TO_DATE('" . date("Y-m-d", strtotime($date_split_array[0])) . ",' 00:00', '%Y-%m-%d %H:%i:%s')", "STR_TO_DATE('" . date("Y-m-d", strtotime($date_split_array[1])) . " 24:00','%Y-%m-%d %H:%i:%s')"]);
            // $model->where(DB::raw("created_at", ">=", "STR_TO_DATE('" . date("Y-m-d", strtotime($date_split_array[0])) . ",' 00:00', '%Y-%m-%d %H:%i:%s')"));
            // $model->where(DB::raw("created_at", "<=", "STR_TO_DATE('" . date("Y-m-d", strtotime($date_split_array[1])) . ",' 00:00', '%Y-%m-%d %H:%i:%s')"));
            //  $model->where('name', 'like', '%' . $data_array['search_text'] . '%');
        }

        if (!empty($data_array['limit'])) {
            $model->limit($data_array['limit']);
        }
        $model->orderBy('created_at', 'desc');

        /* $query = "
        select * from `audit_trails` where (`created_by` = '" . $data_array['users_id'] . "' and `status` = '" . config('constant.STATUS_ACTIVE') . "')   and `audit_trails`.`deleted_at` is null order by `created_at` desc
        ";
        $results = \DB::select("
        select * from `audit_trails` where (`created_by` = '" . $data_array['users_id'] . "' and `status` = '" . config('constant.STATUS_ACTIVE') . "')   and `audit_trails`.`deleted_at` is null order by `created_at` desc
        ");
        echo $query;
        exit();*/
        return $model->get();
    }
}
