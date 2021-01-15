<?php

namespace App\Http\Requests;

use App\Models\Role;


use Illuminate\Foundation\Http\FormRequest;

class SmartFolderFormRequest extends FormRequest
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
        $user_id = \Auth::user()->id;
        $rules = [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:user_smart_folders,name,' . $id . ',id,user_id,' . $user_id . ',deleted_at,NULL',
            'tags' => 'required',
        ];
        return $rules;
    }
}
