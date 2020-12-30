<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\UserTemplateFormRequest;
use App\Models\UserDocument;
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

                $errorMessage = "<ul>";
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
}
