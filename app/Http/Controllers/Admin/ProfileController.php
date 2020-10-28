<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\MessageBag;
use App\Http\Requests\ProfileupdateRequest;


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
    public function update($id="")
    {     
       // echo '<br> user id is '.Auth::user()->id;
       $id=Auth::user()->id;
        //get file settings fields
        $fileConfigData=app('config')->get('upload_config');
        $customConfigData=app('config')->get('custom_config');
        $gender_arr=$customConfigData["gender_arr"];
        //get all constaint values from config file
        $constantDataArray=app('config')->get('constant');
        //directory and place holder for update view file
        $directory=$fileConfigData["profile_picture"]["disk"]."/storage/".$fileConfigData["profile_picture"]["folder"];
        $placeholder=$fileConfigData["profile_picture"]["disk"]."/storage/".$fileConfigData["profile_picture"]["folder"]."/".$fileConfigData["profile_picture"]["placeholder"];     
        //get user and countary data
        $user = User::find($id);
        $Country=Country::all();     
        $countryArray=array();
        foreach($Country as $con_index => $countryOb)
        {
            $countryArray[$countryOb->id]=$countryOb->phonecode." (".$countryOb->iso3.")";  
        }   
          $country_id=$constantDataArray["USA_PHONECODE"];
          if(!empty($user->country_id))
          $country_id=$user->country_id;

        return view('profile/update',['country_id' => $country_id,'user' => $user,'countryArray' => $countryArray,'directory' => $directory,'placeholder' => $placeholder,'gender_arr' => $gender_arr]);
    }
    public function updatesave($id,ProfileupdateRequest $request)
    {
        //get file settings for profile picture field
        $fileConfigData=app('config')->get('upload_config');
        // get user details
        $user = User::find($id); 
        // apply and check validation
        $data=$request->checkvalidate($user->id);
        $data=$request->all();    
        // save profile picture and update database field                
          $field_name="profile_picture" ;         
          if($file = $request->file($field_name))
          {        
            $returnFiles=uploadFile($request,"profile_picture");
            $fileDetailsArray=getUploadedFile($returnFiles,"profile_picture");      
            $fileName=$returnFiles["data"];
            $user::where('id',$id)->update(array('profile_picture' => $fileName));  
          } 
       // save data in table
        $user->fill($data);
        $user->save();

       set_flash('success','Profile updated successfully!');
       return back();
      
    }
    public function deleteprofileimage($id=""){
        // get user details 
        $id=Auth::user()->id;
         $user=User::find($id);
         // get
         $fileConfigData=app('config')->get('upload_config');
         $directory=$fileConfigData["profile_picture"]["disk"]."/storage/".$fileConfigData["profile_picture"]["folder"];
         
         $filenamewithpath=base_path()."/".$directory."/".$user->profile_picture;

 
         
         if(file_exists($filenamewithpath)) 
         {
            @unlink($filenamewithpath);
            User::where('id',$id)->update(array('profile_picture' => ""));
         }

         set_flash('success','Profile image deleted Successfully!');
         return redirect(route("profileupdate"));

    }
    public function profilepasschange(ProfileupdateRequest $request){
        if(Auth::Check())
        {
            $requestData = $request->All();
            $validator = $this->validatePasswords($requestData);
            if($validator->fails())
            {
                $validationObject=$validator->getMessageBag();
               // $errormessages=$validator->getmes
               $errormessages=array();
           $getMessageOb=new GetValidationMesage();
           $errormessages=$getMessageOb->getvalidationMessage($validationObject);
             // echo '<pre>';
              // print_r($errormessages);
              // echo '</pre>';

                $errorStr='<div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.<br><br>
            
                <ul>';
                foreach($errormessages as $error_index => $message)
                {
                    $errorStr.='<li> '.$message."<br/></li>";
                }
                $errorStr.='</ul>';
           
                return response()->json(['error' => $errormessages], 400);
            }
            else
            {
                $currentPassword = Auth::User()->password;
                if(Hash::check($requestData['password'], $currentPassword))
                {
                    $userId = Auth::User()->id;
                    $user = User::find($userId);
                    $user->password = Hash::make($requestData['new-password']);;
                    $user->save();
                    $message='<div class="alert alert-success"> Your password has been updated successfully.</div>';
                    return response()->json(array('message' => $message));
                }
                else
                {
                    $message='<div class="alert alert-danger">

                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                
                    <ul><li>Sorry, your current password was not recognised. Please try again.</li></ul>';
                    return response()->json(['error' => ["Sorry, your current password was not recognised. Please try again#1"]],400);
                }
            }
        }
        else
        {
            // Auth check failed - redirect to domain root
            return redirect()->to('/');
        }
    }

    public function validatePasswords(array $data)
{
    $messages = [
        'password.required' => 'Please enter your current password',
        'new-password.required' => 'Please enter a new password',
        'new-password-confirmation.not_in' => 'Sorry, common passwords are not allowed. Please try a different new password.'
    ];

    $validator = Validator::make($data, [
        'password' => 'required',
        'new-password' => ['required', 'same:new-password', 'min:8', Rule::notIn($this->bannedPasswords())],
        'new-password-confirmation' => 'required|same:new-password',
    ], $messages);

    return $validator;
}
    
    /**
     * Get an array of all common passwords which we don't allow
     *
     * @return array
     */
    public function bannedPasswords(){
        return [
            'password', '12345678', '123456789', 'baseball', 'football', 'jennifer', 'iloveyou', '11111111', '222222222', '33333333', 'qwerty123'
        ];
    }


}
class GetValidationMesage extends MessageBag
{
   public function getvalidationMessage($validationMessage)
   {
       $NewmessageArray=array();
        $error_index=0;
        $messageField="";
       foreach($validationMessage->messages as $index => $messageArray)
       {
           
      // echo '<br> message is '.$messageArray[0];
      if($index=="password")
      $messageField=1;
      if($index=="new-password")
      $messageField=2;
      if($index=="new-password-confirmation")
      $messageField=3;
        $NewmessageArray[$error_index]=$messageArray[0].'#'.$messageField;
        $error_index+=1;
       }
       return $NewmessageArray;
   }

}
