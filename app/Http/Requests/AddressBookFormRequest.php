<?php

namespace App\Http\Requests;

use App\Models\BusinessCategory;

use Illuminate\Foundation\Http\FormRequest;

class AddressBookFormRequest extends FormRequest
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

        //
        return [
            'name' => 'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2,deleted_at,NULL',
            'email' => 'required|email',

        ];
    }
}
