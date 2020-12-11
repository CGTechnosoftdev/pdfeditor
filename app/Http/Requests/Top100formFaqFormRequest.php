<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class Top100formFaqFormRequest extends FormRequest
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
        if($this->faq){
            $id=$this->faq->id;
        }

        return [
            'question' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:faqs,question,'.$id.',id,deleted_at,NULL',
            'answer' => 'required',
        ];
    }
}
