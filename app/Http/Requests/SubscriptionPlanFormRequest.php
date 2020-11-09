<?php

namespace App\Http\Requests;
use App\Models\SubscriptionPlan;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionPlanFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id=NULL;
        if($this->subscription_plan){
            $id=$this->subscription_plan->id;
        }
        //
        return [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:subscription_plans,name,'.$id.',id,deleted_at,NULL',            
            'yearly_amount'   => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'monthly_amount'   => 'required|regex:/^\d*(\.\d{1,2})?$/',            
            'max_team_member'   => 'required|numeric',
    
        ];
    }
}
