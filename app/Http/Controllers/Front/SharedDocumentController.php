<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\UserDocumentUploadFormRequest;
use App\Http\Requests\UserDocumentGetFormRequest;
use App\Http\Requests\UserAddFolderFormRequest;
use App\Http\Requests\BusinessCardFormRequest;
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
use Auth, DB, View, Response;



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

        $document = UserDocument::dataRow(['id' => $dataArray["user_document_id"]]);
        $audit_number_array = config("custom_config.audit_number");
        $key_array["{document_name}"] = $document->name;
        addInAuditTrail($audit_number_array["share"], "share_document", $key_array);
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
            $input_data = $request->all();

            $ret_type = $this->saveInSharedTables($request);

            if ($ret_type) {
                $input_data = $request->all();
                if (!empty($input_data["email"]) && !empty($input_data["name"])) {



                    $emailConfig = config("mail_config.document_share");
                    $userName = $input_data["name"];
                    $userEmail = $input_data["email"];
                    $email_data = [
                        'config_param' => 'document_share',
                        'content_data' => [
                            'name' => $userName,
                            'document_link' => $input_data["public_link"],
                        ],
                    ];
                    Mail::to($userEmail)->send(new CommonMail($email_data, $emailConfig));
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


    public function index($user_document)
    {
        $user = Auth::user();

        $document_id = decrypt($user_document ?? '');
        $document = UserDocument::dataRow(['id' => $document_id]);
        if (empty($document)) {
            abort(404);
        }
        $data_array = [
            'title' => "Send for Share",
            'document' => $document,
            'user' => $user,
            'document_operations' => config('custom_config.document_operations'),
            'automatic_reminder_duration_arr' => config('custom_config.automatic_reminder_duration_arr'),
            'repeat_reminder_duration_arr' => config('custom_config.repeat_reminder_duration_arr'),
            'default_invitation_template' => config('constant.DEFAULT_INVITATION_EMAIL_TEMPLATE'),
            'invitation_templates' => config('custom_config.invitation_email_template'),
        ];
        return view('front.user-document.document-send-for-share', $data_array);
    }

    public function customLinkValidate($data)
    {
        $request = new SharedDocumentFormRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages(), $request->attributes());
        return $validator;
    }

    public function businessCardValidate($data)
    {
        $request = new BusinessCardFormRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages(), $request->attributes());
        return $validator;
    }

    public function checkBusinessCard(Request $request)
    {


        $validator = $this->businessCardValidate($request->all()["personalize_invitation_data"]["business_card"]);
        $response_type = true;
        $response_data = array();
        $response_message = "Business card entry valid!";
        if ($validator->fails()) {

            $errormessages = $validator->getMessageBag()->getMessages();



            $errormsgHTML = "";
            foreach ($errormessages as $errorIndex => $errorMsgArr) {
                $response_data[$errorIndex] = false;

                foreach ($errorMsgArr as $indder_index => $message) {
                    $errormsgHTML .= $message . "<br/>";
                }
            }

            $response_type = false;
            $response_message = $errormsgHTML;
        }

        return response()->json(array(
            'success' => $response_type,
            'data' => $response_data ?? [],
            'message' => $response_message ?? '',
        ), ($response_type == 'success' ? 200 : 422));
    }

    public function saveSendForShare($user_document, Request $request)
    {
        $user = Auth::user();

        $document_id = decrypt($user_document ?? '');
        $document = UserDocument::dataRow(['id' => $document_id]);
        if (empty($document)) {
            abort(404);
        }
        $input_data = $request->input();
        DB::beginTransaction();
        try {
            $share_data = [
                'user_id' => $user->id,
                'share_method' => config('constant.SHARE_METHOD_SHARE'),
                'link' => $input_data['public_link'] ?? generateUniqueLink("SharedDocument", "link"),
                'reminder_duration' => $input_data['reminder_duration'] ?? null,
                'reminder_repeat' => $input_data['reminder_repeat'] ?? null,
            ];
            $share_setting_data = [];
            if (!empty($input_data['authentication_method'])) {
                $share_setting_data['authentication_method'] = json_encode($input_data['authentication_method']);
            }
            if (!empty($input_data['personalize_invitation_data'])) {
                if (!empty($request->file('logo'))) {
                    $uploadedImage = uploadFile($request, 'link_to_fill_invitation_logo');
                    if (!empty($uploadedImage['success'])) {
                        $input_data['personalize_invitation_data']['logo'] = $uploadedImage['data'];
                    }
                }
                if (!empty($request->file('business_card_image'))) {
                    $uploadedImage = uploadFile($request, 'link_to_fill_business_card_image');
                    if (!empty($uploadedImage['success'])) {
                        $input_data['personalize_invitation_data']['business_card']['image'] = $uploadedImage['data'];
                    }
                }
                $share_setting_data['personalize_invitation_data'] = json_encode($input_data['personalize_invitation_data']);
            }
            $share_data += $share_setting_data;

            $key_array["{document_name}"] = $document->name;
            $audit_number_array = config("custom_config.audit_number");
            addInAuditTrail($audit_number_array["share"], "share_document");
            $shared_document = SharedDocument::saveData($share_data);
            $shared_user_documents = SharedUserDocument::saveData(['user_document_id' => $document->id, 'shared_documents_id' => $shared_document->id]);
            if (!empty($input_data['recipient_data'])) {
                $input_data['personalize_invitation_data'];
                $mail_config = [
                    'subject' => $input_data['personalize_invitation_data']['subject'],
                    'content' => $input_data['personalize_invitation_data']['message'],
                    'keywords' => [
                        "{[your_name]}",
                        "{[your_email]}",
                        "{[recipient_name]}"
                    ],
                ];
                foreach ($input_data['recipient_data']['email'] as $key => $email) {
                    $name = $input_data['recipient_data']['name'][$key] ?? '';
                    $notify_status = $input_data['recipient_data']['notify_status'][$key] ?? null;
                    $document_operations = $input_data['recipient_data']['document_operations'][$key] ?? null;
                    $shared_document_user = SharedDocumentUser::saveData([
                        'shared_documents_id' => $shared_document->id,
                        'name' => $name,
                        'email' => $email,
                        'notify_status' => $notify_status,
                        'document_operations' => $document_operations,
                    ]);
                    $userName = "";
                    if (!empty($user->first_name) && !empty($user->last_name)) {
                        $userName = $user->first_name . " " . $user->last_name;
                    }
                    if (!empty($notify_status)) {
                        $mail_data = [
                            'from' => $user->email,
                            'content_data' => [
                                'recipient_name' => $name,
                                'your_name' => $userName,
                                'your_email' => $user->email,
                            ],
                        ];
                        Mail::to($email)->send(new CommonMail($mail_data, $mail_config));
                    }
                }
            }
            DB::commit();
            $response_type = 'success';
            $response_message = "Document send for share successfully";
        } catch (Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        if ($response_type == 'success') {
            return redirect()->route('front.dashboard');
        } else {
            return redirect()->back();
        }
    }

    public function generateUniqueLink(Request $request)
    {
        $share_link = generateUniqueLink("SharedDocument", "link");
        if (!empty($share_link)) {
            $response_data = $share_link;
            $response_type = 'success';
        } else {
            $response_message = 'Error occoured, Please try again';
            $response_type = 'success';
        }

        return response()->json(array(
            'success' => $response_type,
            'data' => $response_data ?? [],
            'message' => $response_message ?? '',
        ), ($response_type == 'success' ? 200 : 422));
    }

    public function addRecipient(Request $request)
    {
        $input_data = $request->input();
        $document_operations = config('custom_config.document_operations');
        $notify_status = config('custom_config.notify_status');
        $view = View::make('front.user-document.receipent-user-info-row')->with(compact('input_data', 'document_operations', 'notify_status'))->render();
        return Response::json(array('html' => $view));
    }
}
