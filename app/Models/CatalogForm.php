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

    protected $fillable = ['name', 'category_id', 'form', 'description', 'status'];

    protected $appends = [
        'form_url', 'category_name'
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
        $model = (empty($model) ? new self() : $model);
        $model->fill($dataArray);
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }
}
