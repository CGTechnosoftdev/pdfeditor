<?php

namespace App\Http\Requests;
use App\Models\Role;


use Illuminate\Foundation\Http\FormRequest;

class PromoUrlFormRequest extends FormRequest
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
        $id=NULL;
        if($this->promo_url){
            $id=$this->promo_url->id;
        }
        $rules=[
            'promotion_name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2|unique:promo_urls,name,'.$id.',id,deleted_at,NULL',
        ];
        return $rules;

    }

}