<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{

    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['name', 'description'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

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

    public function documentTemplates()
    {
        return $this->hasMany(DocumentTemplate::class, 'document_type_id', 'id');
    }
}
