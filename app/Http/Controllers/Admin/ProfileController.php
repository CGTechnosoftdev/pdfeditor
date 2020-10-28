<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileFormRequest;
use App\Models\User;
use App\Models\Country;
//include '../../../Helpers/Common.php';



class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {     
    	$user = \Auth::user();

    	$data_array = ['title'=>'Update Profile','heading'=>'Update Profile'];

    	$data_array['breadcrumb']= \Breadcrumbs::render('profile'); 
    	$data_array['gender_arr']=config('custom_config.gender_arr');
    	$data_array['country_arr'] = Country::getCountryCodeList();

    	$user->country_id = $user->country_id ?? config('constant.DEFAULT_PHONECODE');
    	$user->profile_picture = getUploadedFile($user->profile_picture,'profile_picture',false);
    	$data_array['user'] = $user; 
    	return view('admin/profile/index',$data_array);
    }

    public function update(ProfileFormRequest $request)
    {
    	$user = \Auth::user();
    	$input_data = $request->input();
    	if(!empty($request->file('profile_picture'))){
    		$upload_response = uploadFile($request,'profile_picture');
    		if(!empty($upload_response['success'])){
    			$input_data['profile_picture'] = $upload_response['data'];
    		}
    	}
    	$user =  User::saveData($input_data,$user);
    	set_flash('success','Profile updated successfully!');
    	return redirect(route('dashboard'));

    }
    public function deleteProfilePicture(){
    	$user=\Auth::user();
    	$profile_picture = $user->profile_picture;
    	$user =  User::saveData(['profile_picture'=>''],$user);    	
    	if($user){
    		$remove_file = removeUploadedFile($profile_picture,'profile_picture');
   			$response_type='success';
   			$response_message='Profile image deleted Successfully';
   		}else{
   			$response_type='error';
   			$response_message='Error occoured, Please try again.';
   		}
    	set_flash($response_type,$response_message);
    	return redirect(route("profile"));

    }
    public function profilepasschange(ProfileFormRequest $request){
    	// if(Auth::Check())
    	// {
    	// 	$requestData = $request->All();
    	// 	$validator = $this->validatePasswords($requestData);
    	// 	if($validator->fails())
    	// 	{
    	// 		$validationObject=$validator->getMessageBag();
     //           // $errormessages=$validator->getmes
    	// 		$errormessages=array();
    	// 		$getMessageOb=new GetValidationMesage();
    	// 		$errormessages=$getMessageOb->getvalidationMessage($validationObject);
     //         // echo '<pre>';
     //          // print_r($errormessages);
     //          // echo '</pre>';

    	// 		$errorStr='<div class="alert alert-danger">

    	// 		<strong>Whoops!</strong> There were some problems with your input.<br><br>

    	// 		<ul>';
    	// 		foreach($errormessages as $error_index => $message)
    	// 		{
    	// 			$errorStr.='<li> '.$message."<br/></li>";
    	// 		}
    	// 		$errorStr.='</ul>';

    	// 		return response()->json(['error' => $errormessages], 400);
    	// 	}
    	// 	else
    	// 	{
    	// 		$currentPassword = Auth::User()->password;
    	// 		if(Hash::check($requestData['password'], $currentPassword))
    	// 		{
    	// 			$userId = Auth::User()->id;
    	// 			$user = User::find($userId);
    	// 			$user->password = Hash::make($requestData['new-password']);;
    	// 			$user->save();
    	// 			$message='<div class="alert alert-success"> Your password has been updated successfully.</div>';
    	// 			return response()->json(array('message' => $message));
    	// 		}
    	// 		else
    	// 		{
    	// 			$message='<div class="alert alert-danger">

    	// 			<strong>Whoops!</strong> There were some problems with your input.<br><br>

    	// 			<ul><li>Sorry, your current password was not recognised. Please try again.</li></ul>';
    	// 			return response()->json(['error' => ["Sorry, your current password was not recognised. Please try again#1"]],400);
    	// 		}
    	// 	}
    	// }
    	// else
    	// {
     //        // Auth check failed - redirect to domain root
    	// 	return redirect()->to('/');
    	// }
    }
}