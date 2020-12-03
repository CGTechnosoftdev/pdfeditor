<?php

use Carbon\Carbon;

/**
 * [lang_trans description]
 * @Author            AkashSharma
 * @date              2019-07-08
 * @MethodDescription [Use to get language data as per set language]
 * @param             [type]        $translating_string [element to be get from language data]
 * @param             array         $extra_data         [extra data like variable to be set in language data]
 * @return            [type]                            [description]
 */
function lang_trans($translating_string, $extra_data = array())
{
	return trans($translating_string, $extra_data);
}

/**
 * [set_flash description]
 * @Author            AkashSharma
 * @date              2019-07-08
 * @MethodDescription [Set flash data in session]
 * @param             [type]        $flash_type    [description]
 * @param             [type]        $flash_message [description]
 */
function set_flash($type, $message, $toastr = true)
{
	if (!empty($toastr)) {
		toastr()->$type($message);
	} else {
		Session::flash($type, $message);
	}
}

/**
 * [interpretResponse description]
 * @author Akash Sharma
 * @date   2020-10-29
 * @param  [type]     $message     [description]
 * @param  [type]     $status_code [description]
 * @param  array      $data        [description]
 * @return [type]                  [description]
 */
function interpretResponse($message, $status_code, $data = [])
{
	$success = false;
	if ($status_code == 200) {
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
function uploadFile($request, $file_config)
{
	$fileConfigData = config('upload_config.' . $file_config);

	$files = $request->file($fileConfigData['file_input']);

	$files = (is_array($files) ? $files : array($files));
	if (!empty($fileConfigData['file_input_subkey'])) {
		$files = array_column($files, $fileConfigData['file_input_subkey']);
	}
	$uploadedFiles = array();
	foreach ($files as $file) {
		//Generate name
		$fileNameWithExtension = $file->getClientOriginalName();
		$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
		$extension = $file->getClientOriginalExtension();
		switch ($fileConfigData['new_file_name'] ?? "") {
			case 'orignal_with_random':
				$randomString = generateRandomString(5);
				$newFileName = $fileName . '_' . $randomString . time() . '.' . $extension;
				break;
			case 'orignal':
				$newFileName = $fileNameWithExtension;
				break;
			default:
				$randomString = generateRandomString(5);
				$newFileName = $randomString . time() . '.' . $extension;
		}
		//dd($fileConfigData['disk'].$fileConfigData['folder']."/".$newFileName);
		Storage::disk($fileConfigData['disk'])->put($fileConfigData['folder'] . "/" . $newFileName, fopen($file, 'r+'));
		$uploadedFiles[] = $newFileName;
	}
	$returnData = array('success' => true, 'data' => (empty($fileConfigData['multiple'])) ? reset($uploadedFiles) : $uploadedFiles);
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
function getUploadedFile($files, $file_config, $default_status = true)
{
	$fileConfigData = config('upload_config.' . $file_config);
	$sendMultiple = (is_array($files) ? true : false);
	$files = (is_array($files) ? $files : array($files));
	$filesUrl = array();
	foreach ($files as $file) {
		$file = $file ?: ((empty($default_status) ? '' : $fileConfigData['placeholder']));
		if (!empty($file)) {
			$filesUrl[] = Storage::disk($fileConfigData['disk'])->url("public/" . $fileConfigData['folder'] . "/" . $file);
		} else {
			$filesUrl[] = '';
		}
	}
	return ((empty($sendMultiple)) ? reset($filesUrl) : $filesUrl);
}

/**
 * [moveUploadedFile description]
 * @author Akash Sharma
 * @date   2020-10-29
 * @param  [type]     $file               [description]
 * @param  [type]     $destination_config [description]
 * @param  string     $source_config      [description]
 * @return [type]                         [description]
 */
function moveUploadedFile($file, $destination_config, $source_config = 'temporary')
{
	$destinationConfigData = config('upload_config.' . $destination_config);
	$sourceConfigData = config('upload_config.' . $source_config);
	$fullSourcePath = Storage::disk($sourceConfigData['disk'])->getDriver()->getAdapter()->applyPathPrefix($sourceConfigData['folder'] . "/" . $file);
	$fullDestinationPath = Storage::disk($destinationConfigData['disk'])->getDriver()->getAdapter()->applyPathPrefix($destinationConfigData['folder'] . "/" . $file);

	if (File::exists($fullSourcePath)) {
		return File::move($fullSourcePath, $fullDestinationPath);
	} else {
		return false;
	}
}
/**
 * [removeUploadedFile description]
 * @author Akash Sharma
 * @date   2020-10-29
 * @param  [type]     $files       [description]
 * @param  [type]     $file_config [description]
 * @return [type]                  [description]
 */
function removeUploadedFile($files, $file_config)
{
	$fileConfigData = config('upload_config.' . $file_config);
	return Storage::disk($fileConfigData['disk'])->delete($fileConfigData['folder'] . "/" . $files);
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
function generateRandomString($strength = 16, $type = 'alphanumeric')
{
	$alphanumeric = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$numeric = '0123456789';
	$alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$inputType = $$type;
	$inputLength = strlen($inputType);
	$randomString = '';
	for ($i = 0; $i < $strength; $i++) {
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
function changeDateFormat($date, $format = "")
{
	$return = $date;
	if (!empty($date)) {
		switch ($format) {
			case 'db':
				$new_format = 'Y-m-d';
				break;
			case 'M d,Y':
				$new_format = $format;
				break;
			default:
				$new_format = config('general_settings.date_format') ?? config('constant.PUBLIC_DATE_FORMAT');
				break;
		}
		return Carbon::parse($date)->format($new_format);
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
function changeTimeFormat($time, $format = "")
{
	$return = $time;
	if (!empty($time)) {
		switch ($format) {
			case 'db':
				$new_format = 'H:i:s';
				break;
			default:
				$new_format = config('general_settings.time_format') ?? config('constant.PUBLIC_TIME_FORMAT');
				break;
		}
		return Carbon::parse($time)->format($new_format);
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
function changeDateTimeFormat($datetime, $format = "")
{
	$return = $datetime;
	if (!empty($datetime)) {
		switch ($format) {
			case 'db':
				$new_format = 'Y-m-d H:i:s';
				break;
			default:
				$new_format = (config('general_settings.date_format') ?? config('constant.PUBLIC_DATE_FORMAT')) . " " . (config('general_settings.time_format') ?? config('constant.PUBLIC_TIME_FORMAT'));
				break;
		}
		return Carbon::parse($datetime)->format($new_format);
	}
	return $return;
}

/**
 * [addDaysToDate description]
 * @author Akash Sharma
 * @date   2020-11-17
 * @param  [type]     $days [description]
 * @param  string     $date [description]
 */
function addDaysToDate($days, $date = '')
{
	$date = $date ?? date('Y-m-d H:i:s');
	return Carbon::parse($date)->addDays($days)->format('Y-m-d H:i:s');
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
function myCurrencyFormat($amount)
{
	$return = "0.00";
	if (!is_nan($amount)) {
		$return = number_format($amount, 2);
	}
	$currency_attribute = config('general_settings.currency') ?? config('constant.DEFAULT_CURRNCY');
	$currency_arr = \Arr::pluck(config('custom_config.currency_arr'), 'symbol', 'key');
	return $currency_arr[$currency_attribute] . $return;
}
/**
 * [encryptData description]
 * @author Akash Sharma
 * @date   2020-11-20
 * @param  [type]     $data [description]
 * @return [type]           [description]
 */
function encryptData($data)
{
	return $data;
}
/**
 * [decryptData description]
 * @author Akash Sharma
 * @date   2020-11-20
 * @param  [type]     $data [description]
 * @return [type]           [description]
 */
function decryptData($data)
{
	return $data;
}
