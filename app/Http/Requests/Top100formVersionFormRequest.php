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
        $id=NULL;
        $file_required = 'required';
        if($this->form){
            $id=$this->form->id;
            $file_required = 'nullable|sometimes';
        }
     
        //|unique:form,name,'.$id.',id,deleted_at,NULL

        return [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:forms,name,'.$id.',id,deleted_at,NULL',
            'form_file' => $file_required.'|mimes:pdf'
        ];
    }
}
