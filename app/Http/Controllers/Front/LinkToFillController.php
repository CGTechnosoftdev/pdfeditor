<?php

namespace App\Http\Controllers\Front;

use App\Models\SharedDocument;
use App\Models\SharedUserDocument;
use Illuminate\Http\Request;
use App\Models\UserDocument;
use DB, Exception, Auth;
use Illuminate\Support\Facades\Validator;


class LinkToFillController extends FrontBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function publishLink(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        DB::beginTransaction();
        try {
            $document_id = decrypt($input_data['document'] ?? '');
            $document = UserDocument::dataRow(['id' => $document_id]);
            if (empty($document)) {
                $response_type = 'error';
                $response_message = 'Document not found';
            } else {
                $publish_link = generateUniqueLink("SharedDocument", "link");
                $publish_data = [
                    'user_id' => $user->id,
                    'share_method' => config('constant.SHARE_METHOD_LINKTOFILL'),
                    'link' => $publish_link,
                ];
                $publish_setting_data = [];
                // dd($input_data);
                if (!empty($input_data['security_method'])) {
                    $input_data['security_method']['public_access_expire'] = changeDateFormat(($input_data['security_method']['public_access_expire'] ?? ''), 'db');
                    if (!empty($input_data['security_method']['document_password'])) {
                        $input_data['security_method']['document_password'] = bcrypt($input_data['security_method']['document_password']);
                    }
                    $publish_setting_data['security_method'] = json_encode($input_data['security_method']);
                }
                if (!empty($input_data['authentication_method'])) {
                    $publish_setting_data['authentication_method'] = json_encode($input_data['authentication_method']);
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
                    $publish_setting_data['personalize_invitation_data'] = json_encode($input_data['personalize_invitation_data']);
                }
                if (!empty($input_data['access_privileges'])) {
                    $publish_setting_data['access_privileges'] = json_encode($input_data['access_privileges']);
                }
                if (!empty($input_data['document_notification'])) {
                    $publish_setting_data['document_notification'] = json_encode($input_data['document_notification']);
                };
                $publish_data += $publish_setting_data;
                $shared_document = SharedDocument::saveData($publish_data);
                $shared_user_documents = SharedUserDocument::saveData(['user_document_id' => $document->id, 'shared_documents_id' => $shared_document->id]);
                $facebook_share_link = generateFbShareUrl($publish_link);
                $twitter_share_link = generateTwitterShareUrl($publish_link);
                DB::commit();
                $response_type = 'success';
                $response_message = "Publish successfully";
                $response_data = [
                    'publish_link' => $publish_link,
                    'facebook_share_link' => $facebook_share_link,
                    'twitter_share_link' => $twitter_share_link,
                ];
            }
        } catch (Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 404));
    }

    public function advanceSetting($user_document)
    {
        $document_id = decrypt($user_document ?? '');
        $document = UserDocument::dataRow(['id' => $document_id]);
        if (empty($document)) {
            abort(404);
        }
        $data_array = [
            'title' => "Link to fill advance settings",
            'document' => $document
        ];
        return view('front.user-document.advance-settings-link-to-fill', $data_array);
    }
}
