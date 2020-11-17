<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PaymentFormRequest extends FormRequest
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
        $rules=[
			'subscription_plan_id' => 'required',
            'subscription_plan_type' => 'required',
            'name_on_card' => 'required',
			'card_number' => 'required|max:16',
			'cvv' => 'required|min:3|max:3',
			'expiry_month' => 'required|numeric|between:1,12',
			'expiry_year' => 'required|digits:4',
        ];
        return $rules;
    }
}
