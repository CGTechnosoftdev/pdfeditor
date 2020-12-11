<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPlanUpdateFormRequest extends FormRequest
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
        $rules = [
            'plan_name' => 'required',
            'play_type' => 'required',
            'plan_amount' => 'required',
            'renewal_date' => 'required',
        ];
        return $rules;
    }
}
