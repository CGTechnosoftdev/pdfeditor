<?php

namespace App\Http\Requests;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class FrontUserRegistrationFormRequest extends FormRequest
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
    protected function validateLogin(Request $request)
    {
        $request->validate([

         
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
     
       
        $rules=[
            
            
       
  
        ];
        return $rules;

    }

}