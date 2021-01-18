<?php

namespace App\Http\Requests;

use App\Models\User;


use Illuminate\Foundation\Http\FormRequest;

class UspsFormRequest extends FormRequest
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
        $rules = [
            'from_name' => 'required|max:255|min:2',
            'from_address_line_first' => 'required|max:255|min:2',
            'from_address_line_second' => 'required|max:255|min:2',
            'from_city' => 'required|max:255|min:2',
            'from_state' => 'required|max:255|min:2',
            'from_zip' => 'required|max:255|min:2',
            'to_name' => 'required|max:255|min:2',
            'to_address_line_first' => 'required|max:255|min:2',
            'to_address_line_second' => 'required|max:255|min:2',
            'to_city' => 'required|max:255|min:2',
            'to_state' => 'required|max:255|min:2',
            'to_zip' => 'required|max:255|min:2',
            'color_mode_status' => 'sometimes',
            'delivery_method' => 'required',
        ];
        return $rules;
    }
}
