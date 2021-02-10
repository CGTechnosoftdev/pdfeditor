<?php

namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;


class UserDocumentGetFormRequest extends FormRequest
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
            // 'url' => 'required|url|regex:/^https?:\/\/.*[\\\/].+\.[pdf|png|jpg|jpeg|doc|docx]{2,4}(?![^?])/u',
            'url' => [
                'required',
                'regex:/([a-zA-Z0-9\s_\\.\-\(\):])+\.(pdf|png|jpg|jpeg|doc|docx)($|[?&#])$/'
            ],
            // 'url' => 'required',
        ];
    }

    public function messages()
    {

        return [
            'url.regex' => 'Invalid url, Please enter valid file url',
        ];
    }
}