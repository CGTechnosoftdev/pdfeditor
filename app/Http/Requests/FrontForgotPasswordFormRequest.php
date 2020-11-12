<?php

namespace App\Http\Requests;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class FrontForgotPasswordFormRequest extends FormRequest
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

    public function rules(){
        return [
            'email' => 'required|email',
        ];
    }
    public function messages()
    {
        return [];
    }

}