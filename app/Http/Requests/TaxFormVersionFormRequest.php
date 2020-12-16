<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxFormVersionFormRequest extends FormRequest
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
        $tax_form_id = $this->tax_form->id;
        $form_required = 'required';
        if ($this->tax_form_version) {
            $id = $this->tax_form_version->id ?? $this->tax_form_version;
            $form_required = 'nullable|sometimes';
        }
        $rules = [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:tax_form_versions,name,' . $id . ',id,tax_form_id,' . $tax_form_id . ',deleted_at,NULL',
            'form' =>  $form_required . '|mimes:pdf',
            'description' => 'sometimes|nullable',
        ];
        return $rules;
    }
}
