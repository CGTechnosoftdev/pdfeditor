<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserDocumentAnnotation extends Model
{
    
    use SoftDeletes;
    use BaseModelTrait;
    
    protected $table = 'user_document_annotation';
    protected $fillable = ['user_id', 'document_id', 'annotation_data'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function userDocument()
    {
        return $this->belongsTo(UserDocument::class, 'document_id', 'id');
    }

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
