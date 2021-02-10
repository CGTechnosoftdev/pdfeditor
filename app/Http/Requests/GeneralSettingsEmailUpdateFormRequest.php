<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Auth;


class GeneralSettingsEmailUpdateFormRequest extends FormRequest
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
        $user = Auth::user();
        $rules = [
            'gs_email_new_email'      => 'required|email',
            'gs_email_retype_email'       => 'required|required_with:gs_email_new_email|same:gs_email_new_email|email',
            'gs_email_current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
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
            'gs_email_new_email.required' => 'The new email is required.',
            'gs_email_new_email.email' => 'The new email format is invalid',
            'gs_email_retype_email.required' => 'The retype email is required.',
            'gs_email_retype_email.same' => 'The retype email and new email not match.',
            'gs_email_current_password.required' => 'The current password is required.',

        ];
    }
}
