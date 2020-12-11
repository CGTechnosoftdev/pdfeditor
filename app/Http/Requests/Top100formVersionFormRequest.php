<?php

namespace App\Http\Requests;

use App\Models\Form;
use Illuminate\Foundation\Http\FormRequest;

class Top100formVersionFormRequest extends FormRequest
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
        $type_id = $this->top_100_form->id;
        $form_type = config('constant.TOP_100_FORM');
        $file_required = 'required';
        if ($this->form) {
            $id = $this->form->id;
            $file_required = 'nullable|sometimes';
        }

        //|unique:form,name,'.$id.',id,deleted_at,NULL

        return [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:forms,name,' . $id . ',id,form_type,' . $form_type . ',type_id,' . $type_id . ',deleted_at,NULL',
            'form_file' => $file_required . '|mimes:pdf',
        ];
    }
}
