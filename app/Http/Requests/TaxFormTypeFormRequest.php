<?php

namespace App\Http\Requests;

use App\Models\Role;


use Illuminate\Foundation\Http\FormRequest;

class TaxFormTypeFormRequest extends FormRequest
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
        $id = NULL;
        if ($this->tax_type) {
            $id = $this->tax_type->id ?? $this->tax_type;
        }
        $rules = [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:tax_form_types,name,' . $id . ',id,deleted_at,NULL',
            'slug' =>  'required|regex:/(^[a-zA-Z0-9,\-, ]+$)/u|max:255|min:2|unique:tax_form_types,slug,' . $id . ',id,deleted_at,NULL',
            'description' => 'sometimes|nullable',
        ];
        return $rules;
    }
}
