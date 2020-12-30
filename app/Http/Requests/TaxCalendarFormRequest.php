<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxCalendarFormRequest extends FormRequest
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
            'date' => 'required',
            'tax_type' => 'sometimes|nullable',
            'tax_for' => 'sometimes|nullable',
            'tax_form_id' => 'required_with:tax_for|nullable',
            'description' => 'sometimes|nullable',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'tax_form_id.required_with' => 'Tax form is required.'
        ];
    }
}
