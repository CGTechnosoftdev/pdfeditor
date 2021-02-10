<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\PersonalInformationFormRequest;
use App\Models\User;
use App\Models\Country;
use DB, Auth;

class PersonalInformationController extends FrontBaseController
{
    function __construct()
    {
    }

    public function getPersonalInformation()
    {
        $user = Auth::user();
        $user_model = User::where(["id" => $user->id])->get();
        $countary_list = Country::getCountryCodeList();
        $profile_picture = "";
        if (!empty($user_model[0]))
            $profile_picture = getUploadedFile($user_model[0]->profile_picture, "profile_picture");

        $data_array = [
            'title' => "Personal Information",
            'user_id' => $user->id,
            'user_model' => $user_model[0],
            'countary_list' => $countary_list,
            'profile_picture' => $profile_picture,
        ];
        return view('front.user-account.personal-information', $data_array);
    }

    public function savePersonalInformation(User $user, PersonalInformationFormRequest $request)
    {
        $logged_in_user = Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {

            if ($request->file("profile_picture")) {
                $upload_response = uploadFile($request, 'profile_picture');
                if (!empty($upload_response['success'])) {
                    $input_data["profile_picture"] = $upload_response["data"];
                }
            }

            $user = User::saveData($input_data, $user);

            if ($user) {
                DB::commit();

                $response_type = 'success';
                $response_message = 'Personal Information updated successfully';
            } else {
                DB::rollback();
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->back();
    }
}
