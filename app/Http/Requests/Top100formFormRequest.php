<?php

namespace App\Http\Requests;

use App\Models\Top100Form;
use Illuminate\Foundation\Http\FormRequest;

class Top100formFormRequest extends FormRequest
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
        if ($this->top_100_form) {
            $id = $this->top_100_form->id;
        }


        return [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:top100_forms,name,' . $id . ',id,deleted_at,NULL',
            'slug' => 'required|regex:/(^[a-zA-Z0-9,\- ]+$)/u|max:255|min:2|unique:top100_forms,name,' . $id . ',id,deleted_at,NULL',
            'relevent_keywords' => 'required',

        ];
    }
}
