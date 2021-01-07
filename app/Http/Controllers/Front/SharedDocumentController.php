<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\UserDocumentUploadFormRequest;
use App\Http\Requests\UserDocumentGetFormRequest;
use App\Http\Requests\UserAddFolderFormRequest;
use App\Http\Requests\SharedUserDocumentFormRequest;
use App\Http\Requests\SharedDocumentFormRequest;
use App\Models\UserDocument;
use App\Models\SharedDocument;
use App\Models\SharedUserDocument;
use App\Models\SharedDocumentUser;
use Illuminate\Support\Facades\Validator;


use Auth;

class SharedDocumentController extends FrontBaseController
{
    public function __construct()
    {
    }
    public function getDocumentDetail(UserDocument $user_document)
    {
        $fileUrl = "";
        if (!empty($user_document->name))
            $fileUrl = getUploadedFile([$user_document->name], "user_document");
        $documentDetailArray = [
            'id' => $user_document->id,
            'file_url' => $fileUrl,
            'document_name' => $user_document->name,
        ];
        return response()->json($documentDetailArray);
    }
    public function customEmailValidate($data)
    {
        $request = new SharedUserDocumentFormRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages(), $request->attributes());
        return $validator;
    }

    public function saveInSharedTables($request, $insertType = "single")
    {
        $is_valid = true;
        $share_document_user = "";
        //get shared document id

        $input_data = $request->input();

        //dd($input_data);
        $dataArray["user_id"] = Auth::user()->id;
        // $dataArray["share_type"] = $input_data["share_type"];
        $dataArray["share_method"] = 1;
        if (!empty($input_data["link"]))
            $dataArray["link"] = $input_data["link"];
        else {
            if (
                !empty($input_data["select_template"]) || !empty($input_data["template_subject"]) || !empty($input_data["template_message"])
                || !empty($input_data["first_name"])
                || !empty($input_data["last_name"])
                || !empty($input_data["job_title"])
                || !empty($input_data["Company"])
                || !empty($input_data["business_card_email"])
                || !empty($input_data["phone_number"])
                || !empty($input_data["fax_number"])
                || !empty($input_data["Website"])
                || !empty($input_data["user_advance_automatic_reminder"])
                || !empty($input_data["user_advance_settings_repeat_reminder"])
            ) {
                // $personal_invitation_data["authentication_method"] = $input_data["authentication_method"];
                $personal_invitation_data["first_name"] = $input_data["first_name"];
                $personal_invitation_data["last_name"] = $input_data["last_name"];
                $personal_invitation_data["job_title"] = $input_data["job_title"];
                $personal_invitation_data["Company"] = $input_data["Company"];
                $personal_invitation_data["business_card_email"] = $input_data["business_card_email"];
                $personal_invitation_data["phone_number"] = $input_data["phone_number"];
                $personal_invitation_data["fax_number"] = $input_data["fax_number"];
                $personal_invitation_data["Website"] = $input_data["Website"];
                $personal_invitation_data["user_advance_automatic_reminder"] = $input_data["user_advance_automatic_reminder"];
                $personal_invitation_data["user_advance_settings_repeat_reminder"] = $input_data["user_advance_settings_repeat_reminder"];
                if (!empty($input_data["your_logo"]))
                    $personal_invitation_data["your_logo"] = $input_data["your_logo"];
                //your_logo

                if ($request->file("business_card_picture")) {
                    $upload_response = uploadFile($request, 'business_card_picture');
                    if (!empty($upload_response['success'])) {
                        $personal_invitation_data["business_card_picture"] = $upload_response["data"];
                    }
                }


                $personalDataInvitationStr = json_encode($personal_invitation_data);
                $dataArray["personalize_invitation_data"] = $personalDataInvitationStr;
            }
            if (!empty($input_data["authentication_method"])) {
                $autenticationMethodsStr = implode(",", $input_data["authentication_method"]);
                $dataArray["authentication_method"] = $autenticationMethodsStr;
            }
        }
        $SharedDocument = SharedDocument::saveData($dataArray);

        //get shared user document
        $dataArray = array();
        $dataArray["shared_documents_id"] = $SharedDocument->id;
        $dataArray["user_document_id"] = $input_data["user_document_id"];
        SharedUserDocument::saveData($dataArray);

        //save user info
        if ($insertType == "single") {
            if (!empty($input_data["email"]) && !empty($input_data["name"])) {
                $dataArray = array();
                $dataArray["name"] = $input_data["name"];
                $dataArray["email"] = $input_data["email"];
                $dataArray["shared_documents_id"] = $SharedDocument->id;
                $share_document_user = SharedDocumentUser::saveData($dataArray);
            }
        } else if ($insertType == "multiple") {
            if (!empty($input_data["user_email"]) && !empty($input_data["user_name"])) {
                foreach ($input_data["user_email"] as $userINfoIndex => $userEmail) {
                    $userName = $input_data["user_name"][$userINfoIndex];
                    $dataArray = array();
                    $dataArray["name"] = $userName;
                    $dataArray["email"] = $userEmail;
                    $dataArray["shared_documents_id"] = $SharedDocument->id;
                    $share_document_user = SharedDocumentUser::saveData($dataArray);
                }
            }
        }





        return $is_valid;
    }

    public function userDocumentEmailShareSave(Request $request)
    {
        try {
            $validator = $this->customEmailValidate($request->all());
            if ($validator->fails()) {

                $errormessages = $validator->getMessageBag()->getMessages();

                $errormsgHTML = "<ul>";
                foreach ($errormessages as $errorIndex => $errorMsgArr) {

                    foreach ($errorMsgArr as $indder_index => $message) {
                        $errormsgHTML .= '<li>' . $message . '</li>';
                    }
                }
                $errormsgHTML .= '</ul>';
                //  foreach($errorMessages as $error_index =>  )
                return response()->json(array(
                    'return_type' => 'error',
                    'message' => $errormsgHTML

                ), 400); // 400 being the HTTP code for an invalid request.
            }

            $ret_type = $this->saveInSharedTables($request);

            if ($ret_type) {
                $response_type = 'success';
                $response_message = 'Docuemnt shared successfully,Thank You!';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        return response()->json(["return_type" => $response_type, 'message' => $response_message]);
    }
    public function customLinkValidate($data)
    {
        $request = new SharedDocumentFormRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages(), $request->attributes());
        return $validator;
    }

    public function checkUserEmailForm(Request $request)
    {
        $input_array = $request->all();

        $req_type = $input_array["req_type"];
        if ($req_type == "check_email_name") {
            $userInfoDataArray = array();
            $userInfoDataArray["email"] = $input_array["email"];
            $userInfoDataArray["name"] = $input_array["name"];

            $validator = $this->customEmailValidate($userInfoDataArray);
            if ($validator->fails()) {

                $errormessages = $validator->getMessageBag()->getMessages();

                $errormsgHTML = "<ul>";
                foreach ($errormessages as $errorIndex => $errorMsgArr) {

                    foreach ($errorMsgArr as $indder_index => $message) {
                        $errormsgHTML .= '<li>' . $message . '</li>';
                    }
                }
                $errormsgHTML .= '</ul>';
                //  foreach($errorMessages as $error_index =>  )
                return response()->json(array(
                    'return_type' => 'error',
                    'message' => $errormsgHTML

                )); // 400 being the HTTP code for an invalid request.
            }

            return response()->json(array(
                'return_type' => 'success',
                'message' => 'email validation success!'

            ));
        }
    }

    public function getAdvanceSettings(UserDocument $user_document)
    {

        $fileUrl = "";
        if (!empty($user_document->name))
            $fileUrl = getUploadedFile([$user_document->name], "user_document");

        //authentication_method    
        $data_array["authentication_method"] = config('custom_config.authentication_method');
        $data_array["user_advance_setting_templates"] = config('custom_config.user_advance_setting_templates');
        $data_array["user_advance_settings_automatic_reminder"] = config('custom_config.user_advance_settings_automatic_reminder');
        $data_array["user_advance_settings_repeat_reminder"] = config('custom_config.user_advance_settings_repeat_reminder');
        $data_array["fileUrl"] = $fileUrl[0];
        $data_array["document_name"] = $user_document->name;
        $data_array["document_id"] = $user_document->id;




        return view('front.user-document.document-share-settings', $data_array);
    }
    public function saveAdvanceSettings(Request $request)
    {
        try {
            $input_data = $request->all();
            $is_valid = $this->saveInSharedTables($request, "multiple");

            if ($is_valid) {
                $response_type = 'success';
                $response_message = 'Docuemnt shared successfully,Thank You!';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        //  return view('front.dashboard');
        return redirect()->route('front.dashboard');
    }

    public function userDocumentLinkShareSave(Request $request)
    {
        //SharedDocumentFormRequest
        try {
            $validator = $this->customLinkValidate($request->all());
            if ($validator->fails()) {

                $errormessages = $validator->getMessageBag()->getMessages();

                $errormsgHTML = "<ul>";
                foreach ($errormessages as $errorIndex => $errorMsgArr) {

                    foreach ($errorMsgArr as $indder_index => $message) {
                        $errormsgHTML .= '<li>' . $message . '</li>';
                    }
                }
                $errormsgHTML .= '</ul>';


                //  foreach($errorMessages as $error_index =>  )
                return response()->json(array(
                    'return_type' => 'error',
                    'message' => $errormsgHTML,

                ), 400); // 400 being the HTTP code for an invalid request.
            }



            $share_user_document = $this->saveInSharedTables($request);

            if ($share_user_document) {
                $response_type = 'success';
                $response_message = 'Docuemnt shared successfully,Thank You!';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        return response()->json(["return_type" => $response_type, 'message' => $response_message]);
    }
}
