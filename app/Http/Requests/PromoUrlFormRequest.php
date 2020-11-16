<?php

namespace App\Http\Requests;
use App\Models\Role;


use Illuminate\Foundation\Http\FormRequest;

class PromoUrlFormRequest extends FormRequest
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
    	if($this->promo_url){
    		$id=$this->promo_url->id;
    	}
    	$rules=[
    		'promotion_name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:promo_urls,promotion_name,'.$id.',id,deleted_at,NULL',
    		'subscription_plan_id' => 'required',
    		'monthly_amount' => 'required_if:monthly_amount_type,1',
    		'yearly_amount' => 'required_if:yearly_amount_type,1',
    	];
    	return $rules;

    }

    public function messages()
    {
    	return [
    		'monthly_amount.required_if' => 'Monthly amount is required.',
    		'yearly_amount.required_if' => 'Yearly amount is required.',
    	];
    }

}