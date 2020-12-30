<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxFormFormRequest extends FormRequest
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
        $version_rules = [];
        if ($this->tax_form) {
            $id = $this->tax_form->id ?? $this->tax_form;
        } else {
            $version_rules = [
                'form' => 'required|mimes:pdf',
                'version_description' => 'sometimes|nullable',
                'version_name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2',
            ];
        }
        $category_id = $this->category_id;
        $rules = [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:tax_forms,name,' . $id . ',id,category_id,' . $category_id . ',deleted_at,NULL',
            'category_id' => 'required',
            'description' => 'sometimes|nullable',
            'keywords' => 'sometimes|nullable',
        ];
        return $rules + $version_rules;
    }
}
