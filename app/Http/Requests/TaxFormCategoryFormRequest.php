<?php

namespace App\Http\Requests;

use App\Models\Role;


use Illuminate\Foundation\Http\FormRequest;

class TaxFormCategoryFormRequest extends FormRequest
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
        if ($this->tax_category) {
            $id = $this->tax_category->id ?? $this->tax_category;
        }
        $type_id = $this->type_id;
        $parent_id = $this->parent_id;
        $rules = [
            'type_id' => 'required',
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:tax_form_categories,name,' . $id . ',id,type_id,' . $type_id . ',parent_id,' . $parent_id . ',deleted_at,NULL',
            'slug' =>  'required|regex:/(^[a-zA-Z0-9,\-, ]+$)/u|max:255|min:2|unique:tax_form_categories,slug,' . $id . ',id,type_id,' . $type_id . ',parent_id,' . $parent_id . ',deleted_at,NULL',
            'parent_id' => 'sometimes|nullable',
            'description' => 'sometimes|nullable',
        ];
        return $rules;
    }
}
