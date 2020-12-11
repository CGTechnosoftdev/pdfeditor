<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class LegalForm extends Model
{

    use SoftDeletes;
    use BaseModelTrait;

    protected $table = '360_legal_forms';

    protected $fillable = ['name', 'form', 'description', 'keywords'];
    protected $appends = [
        'form_url', 'keywords_arr'
    ];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function getFormUrlAttribute()
    {
        return  getUploadedFile($this->form, '360_legal_form');
    }

    public function getKeywordsArrAttribute()
    {
        $keywords_arr = explode(", ", $this->keywords);
        return  array_combine($keywords_arr, $keywords_arr);
    }

    public static function saveData($dataArray, $model = array())
    {
        if (!empty($dataArray['keywords'])) {
            $dataArray['keywords'] = (is_array($dataArray['keywords']) ? implode(", ", $dataArray['keywords']) : $dataArray['keywords']);
        }
        $model = (empty($model) ? new self() : $model);
        $model->fill($dataArray);
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }
}
