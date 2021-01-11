<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserDocument;

class Trash extends Model
{
    public static function getTrashList($limit = 5)
    {
        $condition = ['trash' => config('constant.TRASHED')];
        $model = UserDocument::query();
        if (!empty($condition)) {
            $model->where($condition);
        }
        return $model->orderBy('updated_at', 'DESC')->limit($limit)->get();
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
