<?php

namespace App\Http\Requests;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class FrontResetPasswordFormRequest extends FormRequest
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
    protected function validateForm(Request $request)
    {
        $request->validate([

         
        ]);
    }
    public function rules(){
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8|max:32|regex:'.config('constant.PASSWORD_REGEX'),
            'token' => 'required'
        ];
    }
    protected function validationErrorMessages()
    {
        return [];
    }

}