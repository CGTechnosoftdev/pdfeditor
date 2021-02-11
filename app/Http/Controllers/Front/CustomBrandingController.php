<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\CustomBrandingFormRequest;
use App\Models\CustomBranding;
use Auth, DB, View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;

class CustomBrandingController extends FrontBaseController
{
    function __construct()
    {
    }
    public function getCustomBranding()
    {
        $user = Auth::user();
        $custom_brand_id = 0;
        $signature = array();
        $custom_branding_model = CustomBranding::where(["users_id" => $user->id])->first();
        if (!empty($custom_branding_model)) {
            $custom_brand_id = $custom_branding_model->id;

            $signature = json_decode($custom_branding_model->signature, true);
        }
        $template_style = config("custom_config.template_style");
        $template_viewArray = array();
        foreach ($template_style as $temp_index => $templInfoArray) {
            $template_viewArray[$temp_index] = $view = View::make('mail.' . $templInfoArray["email_template"])->render();
        }
        $company_logo = "";
        if (!empty($custom_branding_model->company_logo))
            $company_logo = getUploadedFile($custom_branding_model->company_logo, "company_logo");


        $data_array = [
            'title' => "Custom Branding - Personalized Email Template",
            'user_id' => $user->id,
            'custom_brand_id' => $custom_brand_id,
            'custom_branding_model' => $custom_branding_model,
            'signature' => $signature,
            'template_style' => $template_style,
            'template_viewArray' => $template_viewArray,
            'company_logo' => $company_logo,
        ];
        return view('front.user-account.custom-branding', $data_array);
    }
    public function customBrandingTestEmail(Request $request)
    {
        try {
            $input_data = $request->all();
            // dd($input_data);
            $template_style = config("custom_config.template_style");
            $template_config_name = $template_style[$input_data["template_style_for_email"]]["email_template"];


            $emailConfig = config("mail_config." . $template_config_name);
            $userName = $input_data["signature_first_name"] . " " . $input_data["signature_last_name"];
            $userEmail = $input_data["signature_email"];

            $email_data = [
                'config_param' => $template_config_name,
                'content_data' => [
                    'name' => $userName,
                    'title' => $input_data["signature_title"],
                    'company' => $input_data["signature_company"],
                    'email' => $input_data["signature_email"],
                    'phone' => $input_data["signature_phone"],
                    'fax' => $input_data["signature_fax"],
                ],
            ];
            Mail::to($userEmail)->send(new CommonMail($email_data, $emailConfig));
            $response_type = 'success';
            $response_message = "Test Email send successfully!";
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->back();
    }
    public function customBrandingSave(CustomBrandingFormRequest $request)
    {
        $user = Auth::user();
        $input_data = $request->input();

        DB::beginTransaction();
        try {
            $custom_branding_model = CustomBranding::where(["id" => $input_data["custom_brand_id"]])->get();
            if ($request->file("company_logo")) {
                $upload_response = uploadFile($request, 'company_logo');
                if (!empty($upload_response['success'])) {
                    $input_data["company_logo"] = $upload_response["data"];
                }
            }
            $signature["first_name"] = $input_data["first_name"];
            $signature["last_name"] = $input_data["last_name"];
            $signature["title"] = $input_data["title"];
            $signature["company"] = $input_data["company"];
            $signature["email"] = $input_data["email"];
            $signature["phone"] = $input_data["phone"];
            $signature["fax"] = $input_data["fax"];
            $signature["website"] = $input_data["website"];
            $is_email_template = config("custom_config.is_use_email_template");
            $is_use_email_template = $is_email_template["yes"];
            if (empty($input_data["is_use_email_template"]))
                $is_use_email_template = $is_email_template["no"];
            $input_data["is_use_email_template"] = $is_use_email_template;

            $input_data["signature"] = json_encode($signature);
            $input_data["users_id"] = $user->id;

            if (empty($custom_branding_model[0])) {
                $user = CustomBranding::saveData($input_data);
                $response_message = 'Custom Branding inserted successfully';
            } else {

                $user = CustomBranding::saveData($input_data, $custom_branding_model[0]);
                $response_message = 'Custom Branding updated successfully';
            }

            if ($user) {
                DB::commit();

                $response_type = 'success';
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
