<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserSmartFolder extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['name', 'user_id', 'tags', 'tag_condition', 'status'];
    protected $appends = ['tags_arr', 'user_document_ids', 'document_count'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function getTagsArrAttribute()
    {
        return explode(', ', $this->tags);
    }

    public function getUserDocumentIdsAttribute()
    {
        return UserDocumentTag::with('userDocument')->whereHas('userDocument', function ($q) {
            $q->where('trash', config('constant.NOT_TRASHED'));
            $q->where('encrypted', config('constant.DOCUMENT_ENCRYPTED_NO'));
        })->whereIn('name', $this->tags_arr)->distinct('user_doument_id')->get()->pluck('user_document_id')->toArray();
    }

    public function getDocumentCountAttribute()
    {
        return count($this->user_document_ids);
    }

    public static function saveData($dataArray, $model = array())
    {
        $dataArray['tags'] = implode(', ', $dataArray['tags']);
        $model = (empty($model) ? new self() : $model);
        $model->fill($dataArray);
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }

    public static function getFolderList($data_array)
    {
        $condition = ['user_id' => $data_array['user_id'], 'status' => config('constant.STATUS_ACTIVE')];

        $model = self::query();
        if (!empty($condition)) {
            $model->where($condition);
        }

        if (!empty($data_array['search_text'])) {
            $model->where('name', 'like', '%' . $data_array['search_text'] . '%');
        }

        return $model->orderBy(($data_array['order_by'] ?? 'updated_at'), 'DESC')->get();
    }
}
