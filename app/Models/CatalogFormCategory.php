<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Support\Facades\Crypt;
use phpDocumentor\Reflection\Types\Null_;

class CatalogFormCategory extends Model
{
    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['name', 'slug', 'type', 'parent_id', 'description', 'status'];

    protected $appends = [
        'type_name', 'parent_name'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;


    public function parentCategory()
    {
        return $this->belongsTo(CatalogFormCategory::class, "parent_id", "id");
    }

    public function childCategory()
    {
        return $this->hasMany(CatalogFormCategory::class, "parent_id", "id");
    }

    public function getTypeNameAttribute()
    {
        return config('custom_config.catalog_types')[$this->type] ?? '';
    }


    public function getParentNameAttribute()
    {
        return $this->parentCategory->name ?? '';
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

    public static function getParentCategoryList($condition = array())
    {
        $condition += ['parent_id' => 0];
        return self::dataList($condition);
    }

    public static function getCategoryListArr()
    {
        $return = [];
        $catalog_type = config('custom_config.catalog_types');
        $data_array = self::dataList(['parent_id' => 0]);
        foreach ($data_array as $data) {
            if ($data->childCategory->count() > 0) {
                $return[$data->name . " (" . $catalog_type[$data->type] . ")"] = $data->childCategory->pluck('name', 'id')->toArray();
            }
        }
        return $return;
    }
}
