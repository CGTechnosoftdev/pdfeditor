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
        'template_file_url', 'document_type_name', 'keywords_arr', 'is_popular_status'
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
    public function getIsPopularStatusAttribute()
    {
        $yes_no_arr = config('custom_config.yes_no_arr');
        return  $yes_no_arr[$this->is_popular];
    }
    public function getKeywordsArrAttribute()
    {
        $keywords_arr = explode(", ", $this->keywords);
        return  array_combine($keywords_arr, $keywords_arr);
    }

    public static function saveData($dataArray, $model = array())
    {
        $dataArray['keywords'] = (is_array($dataArray['keywords']) ? implode(", ", $dataArray['keywords']) : $dataArray['keywords']);
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
