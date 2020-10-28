<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileupdateRequest extends FormRequest
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
          
        ];
    }
    public function checkvalidate($userId)
    {
       $data = $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId,
        ]);
        return $data;
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Please enter valid first name.',
            'last_name.required'  => 'Please enter valid last name.',
            
        ];
    }
}
