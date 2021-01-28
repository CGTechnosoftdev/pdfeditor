<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class SharedUserDocument extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['user_document_id', 'shared_documents_id', 'status'];
    protected $append = ['user_document_name'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function getUserDocumentNameAttribute()
    {
        return $this->userDocument->name;
    }

    public function userDocument()
    {
        return $this->belongsTo(UserDocument::class, "user_document_id", "id");
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
}
