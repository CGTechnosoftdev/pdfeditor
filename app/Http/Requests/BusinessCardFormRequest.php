<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class BusinessCardFormRequest extends FormRequest
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
            'first_name' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'last_name' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'job_title' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'company' => 'nullable|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'email' => 'nullable|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/',
            'phone_number' => 'nullable|regex:/^[0-9]{10,12}+$/',
            'fax_number' => 'nullable|regex:/^[0-9]{7,12}+$/',
            'website' => 'nullable|regex:/^([a-z0-9\+_\-\:\/\/]+)(\.[a-z0-9\+_\-]+)*([a-z0-9\-]+\.)+[a-z]{2,6}$/',




        ];
        return $rules;
    }
}
