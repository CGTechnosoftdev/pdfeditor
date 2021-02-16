<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class GeneralSettingsPhoneUpdateFormRequest extends FormRequest
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
            'gs_phone_new_phone'      => 'required|regex:' . config('constant.PHONE_REGEX'),
            'gs_phone_current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
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
            'gs_phone_new_phone.required' => 'The new phone is required.',
            'gs_phone_new_phone.regex' => 'The phone format is invalid.',
            'gs_phone_current_password.required' => 'The current password  is required.',

        ];
    }
}
