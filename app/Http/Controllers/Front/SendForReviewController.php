<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\SharedUserDocumentFormRequest;
use App\Http\Requests\SharedDocumentFormRequest;
use App\Models\UserDocument;
use App\Models\SharedDocument;
use App\Models\SharedUserDocument;
use App\Models\SharedDocumentUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use Auth, DB, View, Response;

class SendForReviewController extends FrontBaseController
{
    public function __construct()
    {
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
            'title' => "Send for Review",
            'document' => $document,
            'user' => $user,
            'document_operations' => config('custom_config.document_operations'),
            'automatic_reminder_duration_arr' => config('custom_config.automatic_reminder_duration_arr'),
            'repeat_reminder_duration_arr' => config('custom_config.repeat_reminder_duration_arr'),
            'default_invitation_template' => config('constant.DEFAULT_INVITATION_EMAIL_TEMPLATE'),
            'invitation_templates' => config('custom_config.invitation_email_template'),
        ];
        return view('front.user-document.document-send-for-review', $data_array);
    }

    public function saveSendForReview($user_document, Request $request)
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
                'share_method' => config('constant.SHARE_METHOD_SENDFORREVIEW'),
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
                    if (!empty($notify_status)) {
                        $mail_data = [
                            'from' => $user->email,
                            'content_data' => [
                                'recipient_name' => $name,
                                'your_name' => $user->full_name,
                                'your_email' => $user->email,
                            ],
                        ];
                        Mail::to($email)->send(new CommonMail($mail_data, $mail_config));
                    }
                }
            }
            DB::commit();
            $response_type = 'success';
            $response_message = "Document send for review successfully";
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
