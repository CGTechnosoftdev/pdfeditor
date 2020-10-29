<?php

namespace App\Http\Requests;
use App\Models\BusinessCategory;

use Illuminate\Foundation\Http\FormRequest;

class BusinessCategoryFormRequest extends FormRequest
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
      // dd($this->BusinessCategory);
    
        $id=NULL;
        if($this->BusinessCategory){
            $id=$this->BusinessCategory->id;
        }
        //
        return [
            'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:business_categories,name,'.$id.',id,deleted_at,NULL',
            'slug' =>  'required|regex:/(^[a-zA-Z0-9,\-, ]+$)/u|max:255|min:2|unique:business_categories,slug,'.$id.',id,deleted_at,NULL',
            'short_description' =>  'required',
            'heading' => 'required',
         
        ];
    }
    public function messages()
    {
        return [

        ];
    }
}
