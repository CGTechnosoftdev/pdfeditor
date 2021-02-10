<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsFolderEncriptPasswordUpdateFormRequest extends FormRequest
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
        $user = \Auth::user();
        $rules = [
            'folder_encript_new_password'      => 'required|min:8|max:32|regex:' . config('constant.PASSWORD_REGEX'),
            'folder_encript_confirm_password' => 'required|required_with:folder_encript_new_password|same:folder_encript_new_password',
            'folder_encript_current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            'folder_encript_new_password.required' => 'The new password  is required.',
            'folder_encript_new_password.min' => "The new password must be at least 8 characters.",
            'folder_encript_new_password.regex' => "The  new password format is invalid.",
            'folder_encript_confirm_password.required' => 'The confirmed password  is required.',
            'folder_encript_confirm_password.same' => 'The confirmed password  and new password must match.',
            'folder_encript_current_password.required' => 'The current password  is required.',
        ];
    }
}
