<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadDocumentRequest extends FormRequest
{
	
	public $validator=null;

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
		$rules=[ 
        	'file' => 'required|mimes:png,jpeg,jpg|max:25000',
        	'documentId' => 'required|exists:user_documents,id',
    	];
        return $rules;
    }

   
    protected function failedValidation(Validator $validator)
    {
    	 $this->validator = $validator;
    }

}