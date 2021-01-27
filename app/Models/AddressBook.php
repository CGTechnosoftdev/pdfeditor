<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{

    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['name', 'email', 'phone', 'fax', 'users_id'];
    protected $appends = [
        'encrypted_id'
    ];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    //
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

    public static function getAddressBook($data_array)
    {
        $condition = ['users_id' => $data_array['user_id'], 'status' => config('constant.STATUS_ACTIVE')];
        $model = self::query();

        if (!empty($condition)) {
            $model->where($condition);
        }


        if (!empty($data_array['search_text'])) {
            $model->where('name', 'like', '%' . $data_array['search_text'] . '%');
        }

        if (!empty($data_array['limit'])) {
            $model->limit($data_array['limit']);
        }
        return $model->get();
    }
}
