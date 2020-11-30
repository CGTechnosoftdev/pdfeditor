<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class DocumentTemplate extends Model
{

    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['document_type_id', 'name', 'template_file', 'keywords', 'is_popular'];
    protected $appends = [
        'template_file_url', 'document_type_name'
    ];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function getTemplateFileUrlAttribute()
    {
        return  getUploadedFile($this->template_file, 'template_file');
    }
    public function getDocumentTypeNameAttribute()
    {
        return  $this->documentType->name;
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

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'id');
    }
}
