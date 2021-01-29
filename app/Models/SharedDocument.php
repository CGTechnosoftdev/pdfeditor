<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BaseModelTrait;
use Illuminate\Database\Eloquent\Model;

class SharedDocument extends Model
{

    use SoftDeletes;
    use BaseModelTrait;
    protected $fillable = ['user_id', 'share_method', 'link', 'security_method', 'authentication_method', 'access_privileges', 'personalize_invitation_data', 'business_card_data', 'document_notification', 'reminder_duration', 'reminder_repeat', 'status'];
    protected $append = ['shared_document_name', 'shared_with_name'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function getSharedDocumentNameAttribute()
    {
        $return = '';
        $documents_list = $this->sharedUserDocuments;
        $count = count($documents_list);
        if (!empty($count)) {
            $return = $documents_list[0]->user_document_name;
            if ($count > 1) {
                $return .= " & " . ($count - 1) . " other's";
            }
        }
        return $return;
    }

    public function getSharedWithNameAttribute()
    {
        $return = '';
        $user_list = $this->sharedDocumentUsers;
        $count = count($user_list);
        if (!empty($count)) {
            $return = $user_list[0]->name ?: $user_list[0]->email;
            if ($count > 1) {
                $return .= " & " . ($count - 1) . " other's";
            }
        }
        return $return;
    }


    public function sharedUserDocuments()
    {
        return $this->hasMany(SharedUserDocument::class, "shared_documents_id", "id");
    }

    public function sharedDocumentUsers()
    {
        return $this->hasMany(SharedDocumentUser::class, "shared_documents_id", "id");
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

    public static function getSharedList($data_array)
    {
        $condition = ['user_id' => $data_array['user_id']];

        $model = self::query()->with('sharedUserDocuments.userDocument', 'sharedDocumentUsers')->whereIn('status', [config('constant.STATUS_ACTIVE'), config('constant.STATUS_INACTIVE')]);

        if (!empty($condition)) {
            $model->where($condition);
        }
        if (!empty($data_array['share_method'])) {
            $model->where('share_method', $data_array['share_method']);
        }
        if (!empty($data_array['search_text'])) {
            $model->where(function ($subQuery) use ($data_array) {
                $subQuery->whereHas('sharedUserDocuments.userDocument', function ($q) use ($data_array) {
                    $q->where('name', 'like', '%' . $data_array['search_text'] . '%');
                })->orWhereHas('sharedDocumentUsers', function ($q) use ($data_array) {
                    $q->where('name', 'like', '%' . $data_array['search_text'] . '%');
                    $q->orWhere('email', 'like', '%' . $data_array['search_text'] . '%');
                });
            });
        }
        $model->orderBy(($data_array['order_by'] ?? 'updated_at'), 'DESC');
        if (!empty($data_array['limit'])) {
            $model->limit($data_array['limit']);
        }
        return $model->get();
    }
}
