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
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use App\Models\User;
use Carbon\Carbon;

use Auth;

class SharedDocumentController extends FrontBaseController
{
    public function __construct()
    {
    }
    public function getDocumentDetail($user_document_encripted)
    {
        $decript_documentId = decrypt($user_document_encripted);
        $user_documentArray = UserDocument::where('id', $decript_documentId)->get();
        if (count($user_documentArray) > 0)
            $user_document = $user_documentArray[0];

        $fileUrl = "";
        if (!empty($user_document->name))
            $fileUrl = getUploadedFile([$user_document->file], "user_document");
        $document = UserDocument::dataRow(['id' => $user_document->id]);
        $public_link = generateUniqueLink("UserDocument", "name");
        $documentDetailArray = [
            'id' => $user_document->id,
            'file_url' => $fileUrl,
            'document_name' => $user_document->name,
            'response_data' => $document,
            'public_link' => $public_link,
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
        $dataArray["share_method"] = config('constant.SHARE_METHOD_SHARE');

        if (!empty($input_data["link"])) {
            $dataArray["link"] = $input_data["link"];
        } else {
            if ($insertType == "multiple") {

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

                if ($request->file("own_logo")) {
                    $upload_response = uploadFile($request, 'own_logo');
                    if (!empty($upload_response['success'])) {
                        $personal_invitation_data["own_logo"] = $upload_response["data"];
                    }
                }

                if ($request->file("business_card_picture")) {
                    $upload_response = uploadFile($request, 'business_card_picture');
                    if (!empty($upload_response['success'])) {
                        $personal_invitation_data["business_card_picture"] = $upload_response["data"];
                    }
                }


                $personalDataInvitationStr = json_encode($personal_invitation_data);
                $dataArray["personalize_invitation_data"] = $personalDataInvitationStr;

                if (!empty($input_data["authentication_method"])) {
                    $autenticationMethodsStr = implode(",", $input_data["authentication_method"]);
                    $dataArray["authentication_method"] = $autenticationMethodsStr;
                }
            }
        }
        $SharedDocument = SharedDocument::saveData($dataArray);

        //get shared user document
        $dataArray = array();
        $dataArray["shared_documents_id"] = $SharedDocument->id;
        if (strlen($input_data["user_document_id"]) > 6)
            $dataArray["user_document_id"] = decrypt($input_data["user_document_id"]);
        else
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

                $errormsgHTML = "";
                foreach ($errormessages as $errorIndex => $errorMsgArr) {
                    foreach ($errorMsgArr as $indder_index => $message) {
                        $errormsgHTML .=  $message . '<br/>';
                    }
                }

                //  foreach($errorMessages as $error_index =>  )
                return response()->json(array(
                    'return_type' => 'error',
                    'message' => $errormsgHTML

                ), 400); // 400 being the HTTP code for an invalid request.
            }

            $ret_type = $this->saveInSharedTables($request);

            if ($ret_type) {
                $input_data = $request->all();
                if (!empty($input_data["email"]) && !empty($input_data["name"])) {
                    $userName = $input_data["name"];
                    $userEmail = $input_data["email"];
                    $email_config = [
                        'config_param' => 'document_share',
                        'content_data' => [
                            'name' => $userName,
                            'document_link' => $input_data["public_link"],
                        ],
                    ];
                    Mail::to($userEmail)->send(new CommonMail($email_config));
                }
                $response_type = 'success';
                $response_message = 'Document shared successfully,Thank You!';
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
                $errormsgHTML = "";
                foreach ($errormessages as $errorIndex => $errorMsgArr) {

                    foreach ($errorMsgArr as $indder_index => $message) {
                        $errormsgHTML .= $message . '<br/>';
                    }
                }

                //  foreach($errorMessages as $error_index =>  )
                return response()->json(array(
                    'return_type' => 'error',
                    'message' => $errormsgHTML,
                )); // 400 being the HTTP code for an invalid request.
            }

            return response()->json(array(
                'return_type' => 'success',
                'message' => 'Email validation success!'

            ));
        }
    }

    public function getAdvanceSettings($user_document_encripted)
    {
        $decript_documentId = decrypt($user_document_encripted);
        $user_documentArray = UserDocument::where('id', $decript_documentId)->get();
        if (count($user_documentArray) > 0)
            $user_document = $user_documentArray[0];

        $fileUrl = "";
        if (!empty($user_document->name))
            $fileUrl = getUploadedFile([$user_document->name], "user_document");
        $document = UserDocument::dataRow(['id' => $user_document->id]);
        $public_link = generateUniqueLink("UserDocument", "name");
        //authentication_method    
        $data_array["authentication_method"] = config('custom_config.authentication_method');
        $data_array["user_advance_setting_templates"] = config('custom_config.user_advance_setting_templates');
        $data_array["user_advance_settings_automatic_reminder"] = config('custom_config.user_advance_settings_automatic_reminder');
        $data_array["user_advance_settings_repeat_reminder"] = config('custom_config.user_advance_settings_repeat_reminder');
        $data_array["fileUrl"] = $fileUrl[0];
        $data_array["document_name"] = $user_document->name;
        $data_array["document_info"] = $document;
        $data_array["document_id"] = $user_document->id;
        $data_array["public_link"] = $public_link;


        return view('front.user-document.document-share-settings', $data_array);
    }
    public function saveAdvanceSettings(Request $request)
    {
        try {
            $input_data = $request->all();
            $is_valid = 1;

            if ($input_data["form_type"] == config('constant.LINK_SHARE_FORM')) {
                if (empty($input_data["link"])) {
                    $response_type = 'error';
                    $response_message = 'Please check public link is empty!';
                    $is_valid = 0;
                }
            } else  if ($input_data["form_type"] == config('constant.EMAIL_SHARE_FORM')) {
                if (empty($input_data["user_email"]) || empty($input_data["user_name"])) {

                    $response_type = 'error';
                    $response_message = 'Please add email address and name to send share link!';
                    $is_valid = 0;
                }
            }

            if ($is_valid == 0) {
                return response()->json(array(
                    'return_type' => $response_type,
                    'return_message' => $response_message,

                ));
            }

            $is_valid = $this->saveInSharedTables($request, "multiple");


            if ($is_valid == 1) {
                //send email
                if (!empty($input_data["user_email"]) && !empty($input_data["user_name"])) {
                    foreach ($input_data["user_email"] as $userINfoIndex => $userEmail) {
                        $userName = $input_data["user_name"][$userINfoIndex];
                        $email_config = [
                            'config_param' => 'document_share',
                            'content_data' => [
                                'name' => $userName,
                                'document_link' => $input_data["publink_link_container"],
                            ],
                        ];
                        Mail::to($userEmail)->send(new CommonMail($email_config));
                    }
                }
                if (!empty($input_data["email"]) && !empty($input_data["name"])) {
                    $dataArray = array();
                    $dataArray["name"] = $input_data["name"];
                    $dataArray["email"] = $input_data["email"];
                }
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
        // return redirect()->route('front.dashboard');
        return response()->json(array(
            'return_type' => $response_type,
            'return_message' => $response_message,

        )); // 400 being the HTTP code for an invalid request.
    }

    public function userDocumentLinkShareSave(Request $request)
    {
        //SharedDocumentFormRequest
        try {
            $validator = $this->customLinkValidate($request->all());
            if ($validator->fails()) {

                $errormessages = $validator->getMessageBag()->getMessages();

                $errormsgHTML = "";
                foreach ($errormessages as $errorIndex => $errorMsgArr) {

                    foreach ($errorMsgArr as $indder_index => $message) {
                        $errormsgHTML .= $message . "<br/>";
                    }
                }



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
