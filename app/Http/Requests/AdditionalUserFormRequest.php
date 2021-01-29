<?php

namespace App\Http\Requests;

use App\Models\User;


use Illuminate\Foundation\Http\FormRequest;

class AdditionalUserFormRequest extends FormRequest
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
        $id = NULL;
        if ($this->additional_user) {
            $id = $this->additional_user->id;
        }
        $rules = [
            'first_name' => 'required|max:50|min:2|regex:/(^[a-zA-Z ]+$)/u',
            'last_name' => 'required|max:50|min:2|regex:/(^[a-zA-Z ]+$)/u',
            'email' => 'required|email|unique:users,email,' . $id . ',id,deleted_at,NULL',
            'contact_number' => 'sometimes|nullable|digits:10|max:10|unique:users,contact_number,' . $id . ',id,deleted_at,NULL',
        ];
        return $rules;
    }
}
