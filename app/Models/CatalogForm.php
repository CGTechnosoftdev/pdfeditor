<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Support\Facades\Crypt;

class CatalogForm extends Model
{
    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['name', 'category_id', 'form', 'keywords', 'description', 'status'];

    protected $appends = [
        'form_url', 'category_name', 'keywords_arr'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(CatalogFormCategory::class, "category_id", "id");
    }

    public function getFormUrlAttribute()
    {
        return  getUploadedFile($this->form, 'catalog_form');
    }

    public function getCategoryNameAttribute()
    {
        $category = $this->category;
        return  $category->name . "(" . $category->parent_name . ")";
    }

    public function getKeywordsArrAttribute()
    {
        $keywords_arr = explode(", ", $this->keywords);
        return  array_combine($keywords_arr, $keywords_arr);
    }

    /**
     * [saveData description]
     * @author Akash Sharma
     * @date   2020-10-28
     * @param  [type]     $dataArray [description]
     * @param  array      $model     [description]
     * @return [type]                [description]
     */
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
