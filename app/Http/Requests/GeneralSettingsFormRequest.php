<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsFormRequest extends FormRequest
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
    	$rules=[                
    		'site_title'     => 'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2',
    		'trail_days'    => 'nullable|integer', 
            'currency'    => 'required', 
            'date_format'    => 'required', 
            'time_format'    => 'required',        
            'facebook_url'    => 'nullable|url',   
            'twitter_url'    => 'nullable|url',   
            'instagram_url'    => 'nullable|url',   
            'linked_in_url'    => 'nullable|url',   
            'ios_app_url'    => 'nullable|url',   
            'android_app_url'    => 'nullable|url',   
        ];
        return $rules;

    }

}