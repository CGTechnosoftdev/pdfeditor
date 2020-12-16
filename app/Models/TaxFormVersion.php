<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Support\Facades\Crypt;

class TaxFormVersion extends Model
{
    use SoftDeletes;
    use BaseModelTrait;

    protected $fillable = ['name', 'tax_form_id', 'form', 'description', 'fillable_printable_status', 'status'];

    protected $appends = [
        'form_url'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function taxForm()
    {
        return $this->belongsTo(TaxForm::class, "tax_form_id", "id");
    }

    public function getFormUrlAttribute()
    {
        return  getUploadedFile($this->form, 'tax_form');
    }

    public function getTaxFormName()
    {
        return  $this->taxForm->name;
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
