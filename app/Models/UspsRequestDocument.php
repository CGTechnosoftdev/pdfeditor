<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\UspsRequest;
use App\Models\UserDocument;

class UspsRequestDocument extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['usps_request_id', 'user_document_id', 'status'];
    protected $appends = [];
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
    public function uspsRequests()
    {
        return $this->belongsTo(UspsRequest::class, 'usps_request_id', 'id');
    }
    public function uspsDocuments()
    {
        return $this->belongsTo(UserDocument::class, 'user_document_id', "id");
    }
}