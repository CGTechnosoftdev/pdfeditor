<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class CustomBrandingFormRequest extends FormRequest
{
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
            'first_name' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'last_name' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'company_logo' => 'nullable|mimes:jpeg,jpg,png|max:2000',
            'title' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'company' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'email' => 'nullable|email',
            'phone' => 'nullable|regex:/(^(\d){10,12}?$)/u',
            'fax' => 'nullable|regex:/(^(\d){7,12}?$)/u',
            'website' => 'nullable|regex:/^([a-z0-9\+_\-\:\/\/]+)(\.[a-z0-9\+_\-]+)*([a-z0-9\-]+\.)+[a-z]{2,6}$/',

        ];
        return $rules;
    }
    public function messages()
    {
        return [];
    }
}
