<?php

namespace App\Http\Requests;
use App\Models\Role;


use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateFormRequest extends FormRequest
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
        if($this->email_template){
            $id=$this->email_template->id;
        }
        $rules=[
            'title' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:email_templates,title,'.$id.',id,deleted_at,NULL',
            'subject' =>  'required',
            'content' =>  'required',
        ];
        return $rules;

    }

}