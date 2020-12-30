<?php

namespace App\Http\Requests;

use App\Models\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

class DocumentTypeFormRequest extends FormRequest
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
        if ($this->document_type) {
            $id = $this->document_type->id;
        }

        return [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:document_types,name,' . $id . ',id,deleted_at,NULL',
        ];
    }
}
