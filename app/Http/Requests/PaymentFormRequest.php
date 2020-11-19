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
            'subscription_plan_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
			'card_number' => 'required|max:19',
			'cvv' => 'required|min:3|max:4',
			'expiry_date' => 'required',
            'zip_code' => 'required',
        ];
        return $rules;
    }
}
