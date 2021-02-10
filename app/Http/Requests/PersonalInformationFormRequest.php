<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class PersonalInformationFormRequest extends FormRequest
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
        $rules = [
            'first_name'      => 'required|max:255|min:2',
            'last_name'       => 'required|max:255|min:2',
            'profile_picture' => 'nullable|mimes:jpeg,jpg,png|max:2000',
        ];
        return $rules;
    }
    public function messages()
    {
        return [];
    }
}
