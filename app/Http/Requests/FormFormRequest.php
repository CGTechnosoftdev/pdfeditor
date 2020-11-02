<?php

namespace App\Http\Requests;
use App\Models\Form;
use Illuminate\Foundation\Http\FormRequest;

class FormFormRequest extends FormRequest
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
        if($this->Form){
            $id=$this->Form->id;
        }
        //|unique:form,name,'.$id.',id,deleted_at,NULL

        return [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2',
        ];
    }
}
