<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['name', 'type', 'user_id', 'thumbnail'];
    protected $appends = [
        'formatted_name', 'thumbnail_url', 'encrypted_id'
    ];
    protected $dates = ['deleted_at'];
    public $timestamps = true;


    public function getFormattedNameAttribute()
    {
        return $this->name;
    }

    public function getThumbnailUrlAttribute()
    {
        return asset('public/front/images/doc-img-1.png');
    }

    public function getEncryptedIdAttribute()
    {
        return encryptData($this->id);
    }

    public function generateLink()
    {
        return route('front.document-link', $this->id);
    }


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

    public static function getUserRecent($user, $type, $limit = 5)
    {
        $condition = ['user_id' => $user->id, 'type' => $type, 'status' => config('constant.STATUS_ACTIVE')];
        $model = self::query();
        if (!empty($condition)) {
            $model->where($condition);
        }
        return $model->orderBy('updated_at', 'DESC')->limit($limit)->get();
    }
}
