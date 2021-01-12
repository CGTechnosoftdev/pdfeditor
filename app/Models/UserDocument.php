<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['name', 'file', 'file_thumbnail', 'type', 'user_id', 'thumbnail', 'trash'];
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

    public static function getFolderList($user_id)
    {
        $condition = ['user_id' => $user_id, 'type' => config('constant.DOCUMENT_TYPE_FOLDER'), 'status' => config('constant.STATUS_ACTIVE')];
        $model = self::query();
        if (!empty($condition)) {
            $model->where($condition);
        }
        return $model->orderBy('updated_at', 'DESC')->get();
    }

    public static function getDocumentList($data_array)
    {
        $document_type = [config('constant.DOCUMENT_TYPE_FILE'), config('constant.DOCUMENT_TYPE_TEMPLATE')];
        $condition = ['user_id' => $data_array['user_id'], 'status' => config('constant.STATUS_ACTIVE')];
        if (!empty($data_array['parent_id'])) {
            $condition['parent_id'] = $data_array['parent_id'];
        }

        if (!empty($data_array['trash'])) {
            $condition['trash'] = config('constant.TRASHED');
        } elseif (!empty($data_array['encrypted'])) {
            $condition['encrypted'] = config('constant.DOCUMENT_ENCRYPTED_YES');
        } else {
            $condition['trash'] = config('constant.NOT_TRASHED');
            $condition['encrypted'] = config('constant.DOCUMENT_ENCRYPTED_NO');
        }

        $model = self::query();
        if (!empty($condition)) {
            $model->where($condition);
        }

        if (!empty($data_array['type']) && in_array($data_array['type'], $document_type)) {
            $model->where('type', $data_array['type']);
        } else {
            $model->whereIn('type', $document_type);
        }

        if (!empty($data_array['search_text'])) {
            $model->where('name', 'like', '%' . $data_array['search_text'] . '%');
        }

        return $model->orderBy(($data_array['order_by'] ?? 'updated_at'), 'DESC')->get();
    }

    public static function emptyTrashList()
    {
        $condition = ['trash' => config('constant.TRASHED')];
        $model = UserDocument::query();
        if (!empty($condition)) {
            $model->where($condition);
        }
        return $model->delete();
    }
}
