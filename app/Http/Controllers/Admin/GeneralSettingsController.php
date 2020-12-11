<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Http\Requests\GeneralSettingsFormRequest;

class GeneralSettingsController extends Controller
{
   	/**
   	 * [__construct description]
   	 * @author Akash Sharma
   	 * @date   2020-11-06
   	 */
   	function __construct()
   	{  
   		$this->middleware('permission:general-settings-edit', ['only' => ['index','update']]);

   	}
   	public function index()
   	{
   		$user = \Auth::user();
   		$data_array = ['title'=>'Update General Settings','heading'=>'Update General Settings'];
   		$data_array['general_setting'] = $user->general_setting;  
   		$data_array['date_format_arr'] = config('custom_config.date_format_arr');  	
   		$data_array['time_format_arr'] = config('custom_config.time_format_arr');  	
   		$data_array['paging_limit_arr'] = config('custom_config.paging_limit_arr');  	
   		$data_array['currency_arr'] = \Arr::pluck(config('custom_config.currency_arr'),'label','key');  	
   		return view('admin.general-setting.index',$data_array);
   	}

	/**
	 * [update description]
	 * @author Akash Sharma
	 * @date   2020-11-06
	 * @param  GeneralSettingsFormRequest $request [description]
	 * @return [type]                       [description]
	 */
	public function updateSetting(GeneralSettingsFormRequest $request)
	{ 
		$user = \Auth::user();
		$inputData=$request->input(); 
		try{
			if(GeneralSetting::saveData($inputData,$user->general_setting)){
				$responseType='success';
				$responseMessage='General Setting updated successfully';
			}else{
				$responseType='error';
				$responseMessage='Error occoured, Please try again.';
			}
		}
		catch (Exception $e){
			$responseType='error';
			$responseMessage=$e->getMessage();
		}
		set_flash($responseType,$responseMessage);
		return redirect()->route('dashboard');
	}
}
