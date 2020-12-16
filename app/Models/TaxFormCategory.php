<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Support\Facades\Crypt;
use phpDocumentor\Reflection\Types\Null_;

class TaxFormCategory extends Model
{
    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['name', 'slug', 'type_id', 'parent_id', 'description', 'status'];

    protected $appends = [
        'type_name', 'parent_name'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;


    public function taxType()
    {
        return $this->belongsTo(TaxFormType::class, "type_id", "id");
    }

    public function parentCategory()
    {
        return $this->belongsTo(TaxFormCategory::class, "parent_id", "id");
    }

    public function childCategory()
    {
        return $this->hasMany(TaxFormCategory::class, "parent_id", "id");
    }

    public function getTypeNameAttribute()
    {
        return $this->taxType->name ?? '';
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
        $data_array = self::dataList(['parent_id' => 0]);
        foreach ($data_array as $data) {
            if ($data->childCategory->count() > 0) {
                $return[$data->name . " (" . $data->type_name . ")"] = $data->childCategory->pluck('name', 'id')->toArray();
            } else {
                $return[$data->id] = $data->name . " (" . $data->type_name . ")";
            }
        }
        return $return;
    }
}
