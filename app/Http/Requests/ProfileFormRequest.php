<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProfileFormRequest extends FormRequest
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
        $id=Auth::user()->id;
        $rules=[                
            'first_name'      => 'required|max:255|min:2',
            'last_name'       => 'max:255|min:2', 
            'email'           => 'required|email|unique:users,email,'.$id,
            'country_id'	  => 'required',
            'contact_number'  => 'required|digits:10|max:10|unique:users,contact_number,'.$id,
            'gender'          => 'required',
            'profile_picture' => 'nullable|mimes:jpeg,jpg,png|max:2000',
            
        ];
        return $rules;

    }

}