<?php

/**
 * [lang_trans description]
 * @Author            AkashSharma
 * @date              2019-07-08
 * @MethodDescription [Use to get language data as per set language]
 * @param             [type]        $translating_string [element to be get from language data]
 * @param             array         $extra_data         [extra data like variable to be set in language data]
 * @return            [type]                            [description]
 */
function lang_trans($translating_string,$extra_data=array()){
	return trans($translating_string,$extra_data);
}

/**
 * [set_flash description]
 * @Author            AkashSharma
 * @date              2019-07-08
 * @MethodDescription [Set flash data in session]
 * @param             [type]        $flash_type    [description]
 * @param             [type]        $flash_message [description]
 */
function set_flash($type,$message,$toastr=true){
	if(!empty($toastr)){
		toastr()->$type($message);    
	}else{    
		Session::flash($type, $message);
	}
}

/**
 * [interpretResponse description]
 * @Author            Veer  Singh
 * @date              2019-07-12
 * @MethodDescription [return response]
 * @param             [type]        $message     [description]
 * @param             [type]        $status_code [description]
 * @param             [type]        $data        [description]
 * @return            [type]                     [description]
 */
function interpretResponse($message,$status_code,$data=[])
{
	$success = false;
	if($status_code == 200){
		$success = true;
	}
	return response()->json([
		"success" 	=> $success,
		"message" 	=> $message,
		"data"  	=> $data,
		"status"      => $status_code
	], $status_code);
}

/**
 * [uploadFile description]
 * @Author            AkashSharma
 * @date              2019-07-17
 * @MethodDescription [this method is use for upload file]
 * @param             [type]        $request     [request data which comes from form]
 * @param             [type]        $file_config [config data of file which already define in config/upload_config.php]
 * @return            [type]                     [return file name's as response with success status]
 */
function uploadFile($request,$file_config){
	$fileConfigData=config('upload_config.'.$file_config);
	$files=$request->file($fileConfigData['file_input']);
	$files=(is_array($files) ? $files : array($files)); 
	if(!empty($fileConfigData['file_input_subkey'])){
		$files = array_column($files, $fileConfigData['file_input_subkey']);    
	}       
	$uploadedFiles=array();
	foreach($files as $file){
        //Generate name
		$fileNameWithExtension=$file->getClientOriginalName();
		$fileName=pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
		$extension = $file->getClientOriginalExtension();
		switch($fileConfigData['new_file_name'] ?? ""){
			case 'orignal_with_random':            
			$randomString=generateRandomString(5);
			$newFileName=$fileName.'_'.$randomString.time().'.'.$extension;
			break;
			case 'orignal':
			$newFileName=$fileNameWithExtension;
			break;
			default:    
			$randomString=generateRandomString(5);
			$newFileName=$randomString.time().'.'.$extension;
		}
		Storage::disk($fileConfigData['disk'])->put($fileConfigData['folder']."/".$newFileName,fopen($file,'r+'));
		$uploadedFiles[]=$newFileName;
	}
	$returnData=array('success'=>true,'data'=>(empty($fileConfigData['multiple'])) ? reset($uploadedFiles) : $uploadedFiles);
	return $returnData;
}

/**
 * [getUploadedFile description]
 * @Author            AkashSharma
 * @date              2019-07-17
 * @MethodDescription [Description]
 * @param             [type]        $files       [requested file's name]
 * @param             [type]        $file_config [requested file type config]
 * @return            [type]                     [url of file's]
 */
function getUploadedFile($files,$file_config){
	$fileConfigData=config('upload_config.'.$file_config);
	$sendMultiple=(is_array($files) ? true : false);    
	$files=(is_array($files) ? $files : array($files));    
	$filesUrl=array();
	foreach($files as $file){
		$file=$file?: ($fileConfigData['placeholder']??"");
		if(!empty($file)){
			$filesUrl[]=Storage::disk($fileConfigData['disk'])->url($fileConfigData['folder']."/".$file);
		}else{
			$filesUrl[]='';
		}

	}
	return ((empty($sendMultiple)) ? reset($filesUrl) : $filesUrl);
}

/**
 * [moveUploadedFile description]
 * @Author            TavikshaAkar
 * @date              2019-09-11
 * @MethodDescription [To move the uploaded file from temporary folder to destination folder]
 * @return            [type]
 */
function moveUploadedFile($file,$destination_config,$source_config='temporary'){
	$destinationConfigData=config('upload_config.'.$destination_config);
	$sourceConfigData=config('upload_config.'.$source_config);
	$fullSourcePath = Storage::disk($sourceConfigData['disk'])->getDriver()->getAdapter()->applyPathPrefix($sourceConfigData['folder']."/".$file);
	$fullDestinationPath=Storage::disk($destinationConfigData['disk'])->getDriver()->getAdapter()->applyPathPrefix($destinationConfigData['folder']."/".$file);

	if(File::exists($fullSourcePath)){
		return File::move($fullSourcePath, $fullDestinationPath);
	}else{
		return false;
	}    
}
/**
 * [moveUploadedFile description]
 * @Author            TavikshaAkar
 * @date              2019-09-11
 * @MethodDescription [To remove the uploaded file from destination folder]
 * @return            [type]
 */
function removeUploadedFile($files,$file_config){
	$fileConfigData=config('upload_config.'.$file_config);
	return Storage::disk($fileConfigData['disk'])->delete($fileConfigData['folder']."/".$files);
}


/**
 * [generateRandomString description]
 * @Author            AkashSharma
 * @date              2019-07-17
 * @MethodDescription [Description]
 * @param             integer       $strength [length of random string]
 * @param             string        $type     [type of string numeric/alpha/alphanumeric]
 * @return            [type]                  [random string]
 */
function generateRandomString($strength = 16,$type='alphanumeric') {
	$alphanumeric='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$numeric='0123456789';
	$alpha='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$inputType=$$type;
	$inputLength = strlen($inputType);
	$randomString = '';
	for($i = 0; $i < $strength; $i++) {
		$randomCharacter = $inputType[mt_rand(0, $inputLength - 1)];
		$randomString .= $randomCharacter;
	}

	return $randomString;
}

/**
 * [changeDateFormat description]
 * @Author            AkashSharma
 * @date              2019-08-07
 * @MethodDescription [Change date format in php]
 * @param             [type]        $date   [date to be format]
 * @param             string        $format [format of date i.e. db/blank]
 * @return            [type]                [formated date]
 */
function changeDateFormat($date,$format=""){
	$return = $date;
	if(!empty($date)){
		switch ($format) {
			case 'db':
			$dateFormat='Y-m-d';
			break;
			default:
			$dateFormat=config('constant.PUBLIC_DATE_FORMAT');
			break;
		}    
		if(is_object($date)){
			$return = date_format($date,$dateFormat);
		}else{			
			$date = str_replace('/', '-', $date);
			$return = date($dateFormat, strtotime($date));    
		}        
	}
	return $return;
}

/**
 * [changeDateTimeFormat description]
 * @Author            AkashSharma
 * @date              2020-04-06
 * @MethodDescription [Description]
 * @param             [type]        $date   [description]
 * @param             string        $format [description]
 * @return            [type]                [description]
 */
function changeTimeFormat($time,$format=""){
	$return = $time;
	if(!empty($time)){
		switch ($format) {
			case 'db':
			$dateFormat='H:i:s';
			break;
			default:
			$dateFormat=config('constant.PUBLIC_TIME_FORMAT');;
			break;
		}   
		if(is_object($time)){
			$return = date_format($time,$dateFormat);
		}else{
			$return = date($dateFormat, strtotime($time));
		}    

	}
	return $return;
}

/**
 * [changeDateTimeFormat description]
 * @Author            AkashSharma
 * @date              2020-04-06
 * @MethodDescription [Description]
 * @param             [type]        $date   [description]
 * @param             string        $format [description]
 * @return            [type]                [description]
 */
function changeDateTimeFormat($datetime,$format=""){
	$return = $datetime;
	if(!empty($datetime)){
		switch ($format) {
			case 'db':
			$dateFormat='Y-m-d H:i:s';
			break;
			default:
			$dateFormat=config('constant.PUBLIC_DATE_TIME_FORMAT');;
			break;
		}    
		if(is_object($datetime)){
			$return = date_format($datetime,$dateFormat);
		}else{			
			$datetime = str_replace('/', '-', $datetime);
			$return = date($dateFormat, strtotime($datetime));
		}    		
	}
	return $return;
}
/**
 * [myCurrencyFormat description]
 * @Author            AkashSharma
 * @date              2020-04-14
 * @MethodDescription [Description]
 * @param             [type]        $amount [description]
 * @param             string        $suffix [description]
 * @return            [type]                [description]
 */
function myCurrencyFormat($amount,$symbol='$'){
	$return="0.00";
	if(!is_nan($amount)){
		$return=number_format($amount,2);
	}
	return $symbol." ".$return;
}

function filterDatatableExternalSearch($requestData){
	$dataArray = array_filter(Arr::pluck($requestData,'value','name'));
	unset($dataArray['_token']);
	return $dataArray;

}