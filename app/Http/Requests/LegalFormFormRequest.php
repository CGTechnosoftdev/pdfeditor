<?php

namespace App\Http\Requests;

use App\Models\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

class LegalFormFormRequest extends FormRequest
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
        $form_required = 'required';
        if ($this->legal_form) {
            $id = $this->legal_form->id;
            $form_required = 'nullable|sometimes';
        }

        return [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:360_legal_forms,name,' . $id . ',id,deleted_at,NULL',
            'form' => $form_required . '|mimes:pdf',
            'description' => 'sometimes|nullable',
            'keywords' => 'sometimes|nullable',
        ];
    }
}
