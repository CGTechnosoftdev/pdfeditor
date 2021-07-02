<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class UserDocumentFiles extends Model
{
    
    use SoftDeletes;
    use BaseModelTrait;
    
    protected $table = 'user_document_files';
    protected $fillable = ['user_id', 'document_id', 'file'];
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

    public function getFileUrl()
    {
        $url = parse_url($this->file);
        $picture_url = "";
        if (!empty($url['scheme']) && ($url['scheme'] == 'https' || $url['scheme'] == "http")) {
            $picture_url = $this->file;
        } else {
            $picture_url = getUploadedFile($this->file, 'document_file');
        }

        return  $picture_url;
    }



}
