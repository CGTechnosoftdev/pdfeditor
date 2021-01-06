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
                $link = generateUniqueLink("SharedDocument", "link");
                $publish_data = [
                    'user_id' => $user->id,
                    'share_method' => config('constant.SHARE_METHOD_LINKTOFILL'),
                    'link' => $link,
                ];
                $shared_document = SharedDocument::saveData($publish_data);
                $shared_user_documents = SharedUserDocument::saveData(['user_document_id' => $document->id, 'shared_documents_id' => $shared_document->id]);
                $facebook_share_link = generateFbShareUrl($shared_document->link);
                $twitter_share_link = generateTwitterShareUrl($shared_document->link);
                DB::commit();
                $response_type = 'success';
                $response_message = "Publish successfully";
                $response_data = [
                    'publish_link' => $shared_document->link,
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
