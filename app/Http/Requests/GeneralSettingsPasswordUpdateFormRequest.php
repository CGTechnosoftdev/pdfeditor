<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsPasswordUpdateFormRequest extends FormRequest
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
            'gs_password_new_password'      => 'required|min:8|max:32|regex:' . config('constant.PASSWORD_REGEX'),
            'gs_password_confirm_password' => 'required|required_with:gs_password_new_password|same:gs_password_new_password',
            'gs_password_current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
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
            'gs_password_new_password.required' => 'The new password  is required.',
            'gs_password_new_password.min' => "The new password must be at least 8 characters.",
            'gs_password_new_password.regex' => "The  new password format is invalid.",
            'gs_password_confirm_password.required' => 'The confirmed password  is required.',
            'gs_password_confirm_password.same' => 'The confirmed password  and new password must match.',
            'gs_password_current_password.required' => 'The current password  is required.',

        ];
    }
}
