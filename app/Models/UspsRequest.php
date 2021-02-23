<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\UspsRequestDocument;
use App\Models\User;

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

    public static function getRequestList($data_array)
    {
        $condition = ['user_id' => $data_array['user_id'], 'status' => config('constant.STATUS_ACTIVE')];

        $model = self::query();
        if (!empty($condition)) {
            $model->where($condition);
        }
        if (!empty($data_array['search_text'])) {
            $model->where('to_name', 'like', '%' . $data_array['search_text'] . '%');
        }
        $model->orderBy(($data_array['order_by'] ?? 'updated_at'), 'DESC');
        if (!empty($data_array['limit'])) {
            $model->limit($data_array['limit']);
        }
        return $model->get();
    }
    public function uspsRequestDocuments()
    {
        return $this->hasMany(UspsRequestDocument::class, 'usps_request_id', 'id');
    }
    public function getUspsRequestUser()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
