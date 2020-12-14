<?php

namespace App\Http\Requests;

use App\Models\Role;


use Illuminate\Foundation\Http\FormRequest;

class CatalogFormCategoryFormRequest extends FormRequest
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
        if ($this->catalog_category) {
            $id = $this->catalog_category->id ?? $this->catalog_category;
        }
        $type = $this->type;
        $parent_id = $this->parent_id;
        $rules = [
            'type' => 'required',
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:catalog_form_categories,name,' . $id . ',id,type,' . $type . ',parent_id,' . $parent_id . ',deleted_at,NULL',
            'slug' =>  'required|regex:/(^[a-zA-Z0-9,\-, ]+$)/u|max:255|min:2|unique:catalog_form_categories,slug,' . $id . ',id,type,' . $type . ',parent_id,' . $parent_id . ',deleted_at,NULL',
            'parent_id' => 'sometimes|nullable',
            'description' => 'sometimes|nullable',
        ];
        return $rules;
    }
}
