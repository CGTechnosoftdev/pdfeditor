<?php

namespace App\Http\Requests;
use App\Models\User;


use Illuminate\Foundation\Http\FormRequest;

class SubAdminFormRequest extends FormRequest
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
        $id=NULL;
        $password_requred = 'required';
        if($this->sub_admin){
            $id=$this->sub_admin->id;
            $password_requred = 'sometimes';
        }
        $rules=[
            'first_name' => 'required|max:50|min:2|regex:/(^[a-zA-Z0-9 ]+$)/u',
            'last_name' => 'required|max:50|min:2|regex:/(^[a-zA-Z0-9 ]+$)/u',
            'email' => 'required|email|unique:users,email,'.$id.',id,deleted_at,NULL',
            'contact_number' => 'sometimes|nullable|digits:10|max:10|unique:users,contact_number,'.$id.',id,deleted_at,NULL',
            'gender' => 'required',
            'role_id' => 'required',            
            'profile_picture' => 'nullable|mimes:jpeg,jpg,png|max:2000',
            'password' => $password_requred.'|nullable|min:8|max:32|regex:'.config('constant.PASSWORD_REGEX'),
            'confirm_password' => 'sometimes|same:password|required_with:password',
            'status' => 'required'
        ];
        return $rules;

    }

}