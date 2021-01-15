<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserDocumentTag extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['name', 'user_document_id', 'color', 'status'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function userDocument()
    {
        return $this->belongsTo(UserDocument::class, 'user_document_id', 'id');
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

    public static function getUserTagsList($user_id)
    {
        return self::with('userDocument')->whereHas('userDocument', function ($q)  use ($user_id) {
            $q->where('user_id', $user_id);
        })->select('name')->distinct()->get()->pluck('name', 'name')->toArray();
    }
}
