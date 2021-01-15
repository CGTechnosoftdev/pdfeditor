<?php

namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;


class SharedUserDocumentFormRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'name' => 'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2,deleted_at,NULL',

        ];
    }


    public function attributes()
    {
        return [];
    }
    public function messages()
    {

        return [];
    }
}
