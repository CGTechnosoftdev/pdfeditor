<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseModelTrait;

class UserSubscription extends Model
{
    use BaseModelTrait;
    protected $fillable = ['subscription_plan_id', 'subscription_plan_type', 'user_id', 'start', 'end', 'transaction_id', 'status'];
    protected $appends = [
        'reference_id', 'transaction_date_time', 'payment_method', 'plan_name', 'plan_amount', 'plan_expiry', 'payment_status'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id', 'id');
    }

    public function getReferenceIdAttribute()
    {
        return $this->transaction->reference_id ?? '-';
    }

    public function getTransactionDateTimeAttribute()
    {
        return changeDateTimeFormat($this->created_at);
    }

    public function getPaymentMethodAttribute()
    {
        return $this->transaction->payment_method ?? '-';
    }
    public function getPlanNameAttribute()
    {
        $plan_type_arr = config('custom_config.plan_type_arr');
        return $this->subscriptionPlan->name . " (" . $plan_type_arr[$this->subscription_plan_type] . ")";
    }
    public function getPlanAmountAttribute()
    {
        return myCurrencyFormat($this->transaction->amount ?? '0.00', $this->transaction->currency ?? '');
    }
    public function getPaymentStatusAttribute()
    {
        $payment_status =  $this->transaction->payment_status ?? '';
        return (empty($payment_status) ? '' : config('custom_config.payment_status_arr.' . $payment_status));
    }
    public function getPlanExpiryAttribute()
    {
        return changeDateFormat($this->end);
    }

    /**
     * [saveData description]
     * @author Akash Sharma
     * @date   2020-11-06
     * @param  [type]     $dataArray [description]
     * @return [type]                [description]
     */
    public static function saveData($dataArray, $model = array())
    {
        if (!empty($dataArray['start'])) {
            $dataArray['start'] = changeDateTimeFormat($dataArray['start'], 'db');
        }
        if (!empty($dataArray['end'])) {
            $dataArray['end'] = changeDateTimeFormat($dataArray['end'], 'db');
        }
        $model = (empty($model) ? new self() : $model);
        $model->fill($dataArray);
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }
}
