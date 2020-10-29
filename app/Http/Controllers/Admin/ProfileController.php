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
    	$user->profile_picture_url = getUploadedFile($user->profile_picture,'profile_picture');
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
        if(!empty($input_data['current_password']) && !Hash::check($input_data['current_password'], $user->password)){
            $response_type='error';
            $response_message="Invalid current password";
        }elseif(User::saveData($input_data,$user)){
            $response_type='success';
            $response_message="Password update successfully";
        }else{
            $response_type='error';
            $response_message='Error occoured, Please try again.';
        };
        set_flash($response_type,$response_message);
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
}