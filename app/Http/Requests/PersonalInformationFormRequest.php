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
            'first_name'      => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'last_name'       => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'profile_picture' => 'nullable|mimes:jpeg,jpg,png|max:2000',
            'contact_number' => 'nullable|regex:/(^(\d){10,12}?$)/u',
            'fax_number' => 'nullable|regex:/(^(\d){7,12}?$)/u',
            'company_name' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'company_job_title' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'zip_code' => 'nullable|regex:/(^(\d){5,6}?$)/u',


        ];
        return $rules;
    }
    public function messages()
    {
        return [];
    }
}
