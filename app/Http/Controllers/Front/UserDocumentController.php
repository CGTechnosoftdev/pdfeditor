<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\UserDocumentUploadFormRequest;
use App\Http\Requests\UserDocumentGetFormRequest;
use App\Http\Requests\UserAddFolderFormRequest;
use App\Models\UserDocument;
use DB, Auth, View, Response, Cookie, Hash;

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

    public function index()
    {
        $user = Auth::user();
        $data_array = [
            'title' => 'My Documents',
        ];
        $data_array['folders_list'] = UserDocument::getFolderList($user->id)->pluck('name', 'encrypted_id')->toArray();
        $data_array["footer_menu"] = true;
        return view('front.user-document.list', $data_array);
    }

    public function getDocumentListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $document_params = [];
        $document_params['user_id'] = $user->id;
        $document_params['type'] = config('constant.DOCUMENT_TYPE_FILE');
        $document_params['parent_id'] = $input_data['folder_name'] ?? null;
        $document_params['search_text'] = $input_data['search_text'] ?? null;
        $document_params['order_by'] = $input_data['sort_by'] ?? null;

        $documents = UserDocument::getDocumentList($document_params);
        $view = View::make('front.user-document.items-with-checkbox')->with('documents', $documents)->render();
        $count = count($documents);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function encryptedDocumentList(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $data_array = [
            'title' => 'Encrypted',
        ];
        if (!empty($input_data)) {
            if (!empty($input_data['encryption_password']) && Hash::check($input_data['encryption_password'], $user->password)) {
                Cookie::queue('encryption_success', strtotime(date("Ymdhis")), 1);
            } else {
                set_flash('error', 'Invalid Encryption Password');
            }
            return redirect()->route('front.encrypted-document-list');
        } else {
            $data_array["disable_encription"] = Cookie::get('encryption_success');
        }

        $data_array["footer_menu"] = true;
        return view('front.user-document.encrypted-list', $data_array);
    }

    public function getEncryptedDocumentListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $document_params = [];
        $document_params['user_id'] = $user->id;
        $document_params['encrypted'] = true;
        $document_params['type'] = config('constant.DOCUMENT_TYPE_FILE');
        $document_params['parent_id'] = $input_data['folder_name'] ?? null;
        $document_params['search_text'] = $input_data['search_text'] ?? null;
        $document_params['order_by'] = $input_data['sort_by'] ?? null;

        $documents = UserDocument::getDocumentList($document_params);
        $view = View::make('front.user-document.items-with-checkbox')->with('documents', $documents)->render();
        $count = count($documents);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function viewDocument()
    {
    }

    public function uploadNew(UserDocumentUploadFormRequest $request)
    {
        $input_data = $request->input();
        $user = Auth::user();
        if (in_array($input_data['type'], [config('constant.DOCUMENT_TYPE_FILE'), config('constant.DOCUMENT_TYPE_TEMPLATE')])) {
            $upload_response = uploadFile($request, 'user_document');
            if (!empty($upload_response['success'])) {
                $input_data['user_id'] = $user['id'];
                $input_data['name'] = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);
                $input_data['file'] = $upload_response['data'];
                $input_data['file_thumbnail'] = '';
                $user_document_form = UserDocument::saveData($input_data);
                if ($user_document_form) {
                    $response_type = 'success';
                    $response_message = 'Uploaded successfully';
                } else {
                    $response_type = 'error';
                    $response_message = 'Error occoured, Please try again.';
                }
            } else {
                $response_type = 'error';
                $response_message = 'Unable to upload file, Please try again.';
            }
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message
        ), (($response_type == 'success') ? 200 : 422));
    }

    public function getFromUrl(UserDocumentGetFormRequest $request)
    {
        $input_data = $request->input();
        $user = Auth::user();
        if (in_array($input_data['type'], [config('constant.DOCUMENT_TYPE_FILE'), config('constant.DOCUMENT_TYPE_TEMPLATE')])) {
            $upload_response = uploadFile($input_data['url'], 'user_document', true);
            if (!empty($upload_response['success'])) {
                $input_data['user_id'] = $user['id'];
                $input_data['name'] = $upload_response['data'];
                $user_document_form = UserDocument::saveData($input_data);
                if ($user_document_form) {
                    $response_type = 'success';
                    $response_message = 'Uploaded successfully';
                } else {
                    $response_type = 'error';
                    $response_message = 'Error occoured, Please try again.';
                }
            } else {
                $response_type = 'error';
                $response_message = 'Unable to upload file, Please try again.';
            }
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message
        ), (($response_type == 'success') ? 200 : 422));
    }

    public function addNewFolder(UserAddFolderFormRequest $request)
    {
        $input_data = $request->input();
        $user = Auth::user();
        $input_data['user_id'] = $user['id'];
        $input_data['type'] = config('constant.DOCUMENT_TYPE_FOLDER');
        $add_new_folder = UserDocument::saveData($input_data);
        if ($add_new_folder) {
            $response_type = 'success';
            $response_message = 'Folder created successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Error occoured, Please try again.';
        }
        set_flash($response_type, $response_message);
        return redirect()->back();
    }

    public function getDocumentInfo(Request $request)
    {
        $input_data = $request->input();
        $document_id = decrypt($input_data['document'] ?? '');
        $document = UserDocument::dataRow(['id' => $document_id]);
        if (empty($document)) {
            $response_type = 'error';
            $response_message = 'Document not found';
        } else {
            $response_type = 'success';
            $response_data = $document;
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 404));
    }
}
