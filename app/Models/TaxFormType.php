<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Support\Facades\Crypt;
use phpDocumentor\Reflection\Types\Null_;

class TaxFormType extends Model
{
    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['name', 'slug', 'description', 'status'];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function taxCategory()
    {
        return $this->hasMany(TaxFormCategory::class, "type_id", "id");
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
