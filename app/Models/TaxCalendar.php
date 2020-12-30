<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Support\Facades\Crypt;

class TaxCalendar extends Model
{
    use SoftDeletes;
    use BaseModelTrait;

    protected $table = 'tax_calendar';

    protected $fillable = ['date', 'tax_for', 'tax_form_id', 'applicable_for', 'description', 'status'];

    protected $appends = [
        'form_url', 'form_name', 'tax_for_name'
    ];

    protected $dates = ['deleted_at'];

    public $timestamps = true;

    public function taxForm()
    {
        return $this->belongsTo(TaxForm::class, "tax_form_id", "id");
    }

    public function getTaxForNameAttribute()
    {
        return  config('custom_config.tax_for_arr')[$this->tax_for] ?? 'General';
    }

    public function getFormUrlAttribute()
    {
        return  $this->taxForm->form_url ?? '';
    }

    public function getFormNameAttribute()
    {
        return  $this->taxForm->name ?? '';
    }

    public function getDateAttribute()
    {
        return changeDateFormat(($this->date ?? $this->attributes['date']));
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
        $model->date = changeDateFormat($model->date, 'db');
        if (empty($model->tax_for)) {
            $model->tax_form_id = null;
            $model->applicable_for = null;
        }
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }
}
