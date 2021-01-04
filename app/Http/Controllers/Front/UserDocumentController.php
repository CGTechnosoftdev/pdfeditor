<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\UserTemplateFormRequest;
use App\Http\Requests\SharedUserDocumentFormRequest;
use App\Http\Requests\SharedDocumentFormRequest;
use App\Models\UserDocument;
use App\Models\SharedDocument;
use App\Models\SharedUserDocument;
use App\Models\SharedDocumentUser;
use Illuminate\Support\Facades\Validator;


use Auth;

class UserDocumentController extends FrontBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function templateForm()
    {
        echo '<br> route name ' . \Route::currentRouteName();
        return view('front.user-document.template-form');
    }
    public function customValidate($data)
    {
        $request = new UserTemplateFormRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages(), $request->attributes());
        return $validator;
    }
    public function templateFormSave(Request $request)
    {
        try {

            $validator = $this->customValidate($request->all());


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

            //$validator = Validator::make($request->all(), $request::rules());



            $input_data = $request->input();

            if (!empty($request->file('name'))) {

                $upload_response = uploadFile($request, 'user_template_file');
                if (!empty($upload_response['success'])) {
                    $input_data['name'] = $upload_response['data'];
                }
            }
            $input_data["user_id"] = Auth::user()->id;
            $user_template_form = UserDocument::saveData($input_data);

            if ($user_template_form) {
                $response_type = 'success';
                $response_message = 'User Template added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        // set_flash($response_type, $response_message);
        // return redirect()->route('front.user-document.template-form');
        return response()->json(["return_type" => $response_type, 'message' => $response_message]);
    }
    public function getDocumentDetail(UserDocument $user_document)
    {
        $fileUrl = "";
        if (!empty($user_document->name))
            $fileUrl = getUploadedFile([$user_document->name], "user_template_file");
        $documentDetailArray = [
            'id' => $user_document->id,
            'file_url' => $fileUrl,
        ];
        return response()->json($documentDetailArray);
    }
    public function customEmailValidate($data)
    {
        $request = new SharedUserDocumentFormRequest();
        $validator = Validator::make($data, $request->rules(), $request->messages(), $request->attributes());
        return $validator;
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
            //get shared document id
            $input_data = $request->input();
            //dd($input_data);
            $dataArray["user_id"] = Auth::user()->id;
            $dataArray["share_type"] = $input_data["share_type"];
            $SharedDocument = SharedDocument::saveData($dataArray);

            //get shared user document
            $dataArray = array();
            $dataArray["shared_documents_id"] = $SharedDocument->id;
            $dataArray["user_document_id"] = $input_data["user_document_id"];
            SharedUserDocument::saveData($dataArray);

            //save user info
            $dataArray = array();
            $dataArray["name"] = $input_data["name"];
            $dataArray["email"] = $input_data["email"];
            $dataArray["shared_documents_id"] = $SharedDocument->id;




            $share_document_user = SharedDocumentUser::saveData($dataArray);

            if ($share_document_user) {
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
            $fileUrl = getUploadedFile([$user_document->name], "user_template_file");

        //authentication_method    
        $data_array["authentication_method"] = config('custom_config.authentication_method');
        $data_array["user_advance_setting_templates"] = config('custom_config.user_advance_setting_templates');
        $data_array["user_advance_settings_automatic_reminder"] = config('custom_config.user_advance_settings_automatic_reminder');
        $data_array["user_advance_settings_repeat_reminder"] = config('custom_config.user_advance_settings_repeat_reminder');
        $data_array["fileUrl"] = $fileUrl[0];
        $data_array["document_name"] = $user_document->name;



        return view('front.user-document.document-share-settings', $data_array);
    }
    public function saveAdvanceSettings(Request $request)
    {
        $input_data = $request->all();
        echo '<pre>';
        print_r($input_data);
        echo '</pre>';
        exit();
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

            $input_data = $request->input();
            $dataArray["user_id"] = Auth::user()->id;
            $dataArray["share_type"] = $input_data["share_type"];
            $dataArray["link"] = $input_data["link"];
            $SharedDocument = SharedDocument::saveData($dataArray);

            //get shared user document
            $dataArray = array();
            $dataArray["shared_documents_id"] = $SharedDocument->id;
            $dataArray["user_document_id"] = $input_data["user_document_id"];
            $share_user_document = SharedUserDocument::saveData($dataArray);

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
