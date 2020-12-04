<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseModelTrait;

class UserSubscription extends Model
{
    use BaseModelTrait;
    protected $fillable = ['subscription_plan_id', 'subscription_plan_type', 'user_id', 'start', 'end', 'transaction_id', 'status'];
    protected $appends = ['billing_period', 'amount', 'payment_status'];


    public function getBillingPeriodAttribute()
    {
        return  changeDateFormat($this->start, 'M d,Y') . "-" . changeDateFormat($this->end, 'M d,Y');
    }

    public function getAmountAttribute()
    {
        $myAmount = 0.00;
        if (!empty($this->transaction->amount)) {
            $myAmount = myCurrencyFormat($this->transaction->amount);
        }
        return  $myAmount;
    }
    public function getPaymentStatusAttribute()
    {
        $status = null;
        if (!empty($this->transaction_id)) {
            if ($this->transaction->payment_status == config("constant.PAYMENT_STATUS_PENDING"))
                $status = "Pending";
            elseif ($this->transaction->payment_status == config("constant.PAYMENT_STATUS_SUCCESS"))
                $status = "Success";
            elseif ($this->transaction->payment_status == config("constant.PAYMENT_STATUS_FAILED"))
                $status = "Fail";
        }

        return $status;
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
        $model = (empty($model) ? new self() : $model);
        $model->fill($dataArray);
        if ($model->save()) {
            return $model;
        } else {
            return false;
        }
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, "transaction_id", "id");
    }
    public function SubscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, "subscription_plan_id", "id");
    }
}
