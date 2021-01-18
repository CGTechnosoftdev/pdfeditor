<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\UserDocumentUploadFormRequest;
use App\Http\Requests\UserDocumentGetFormRequest;
use App\Http\Requests\UserAddFolderFormRequest;
use App\Http\Requests\DocumentRenameFormRequest;
use App\Http\Requests\SmartFolderFormRequest;

use App\Models\UserDocument;
use App\Models\UserDocumentTag;
use App\Models\UserSmartFolder;
use App\Models\UspsRequest;
use App\Models\UspsRequestDocument;
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
        $req_type = "";
        $item_container_id = 'move_to_trash_document_trigger_';
        $routeStr = "front.user-document.items-with-checkbox";
        if (!empty($input_data["req_type"]) && $input_data["req_type"] == "update_list") {
            $req_type = $input_data["req_type"];
            $routeStr = "front.user-document.items-without-checkbox";
            $document_params['type'] = $input_data["type"];
            $document_params['encrypted'] = false;
            if ($document_params['type'] == config('constant.DOCUMENT_TYPE_TEMPLATE'))
                $item_container_id = 'move_to_trash_template_trigger_';
        }


        $documents = UserDocument::getDocumentList($document_params);
        $view = View::make($routeStr)->with(['documents' => $documents, 'item_container_id' => $item_container_id])->render();
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
        // if ($response_type == 'success') {
        //     set_flash("success", $response_message);
        // }
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
                $input_data['name'] = pathinfo($input_data['url'], PATHINFO_FILENAME);
                $input_data['file'] = $upload_response['data'];
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
        if ($response_type == 'success') {
            set_flash("success", $response_message);
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

    public function renameDocumentSave(DocumentRenameFormRequest $request)
    {
        $input_data = $request->input();
        $user = Auth::user();
        $is_valid = 0;
        if (!empty($input_data["document_id"])) {
            $input_data["document_id"] = decrypt($input_data["document_id"]);
            $user_documentArray = UserDocument::where('id', $input_data["document_id"])->get();
            if (count($user_documentArray) > 0) {
                $user_document = $user_documentArray[0];
                $data_array["name"] = $input_data["name"];
                if (UserDocument::saveData($data_array, $user_document)) {
                    $is_valid = 1;
                }
            }
        }
        if ($is_valid == 1) {

            $dataArray = [
                "status" => true,
                'response_type' => 'success',
                'message' => 'Document rename successfully',
            ];
        } else {

            $dataArray = [
                "status" => false,
                'response_type' => 'error',
                'message' => 'Error occoured, Please try again.',
            ];
        }
        set_flash($dataArray["response_type"], $dataArray["message"]);
        return redirect()->back();
        //  return response()->json($dataArray, (($is_valid == 1) ? 200 : 422));
    }
    public function documentDownload($user_document_encripted, Request $request)
    {
        $fileConfigData = config('upload_config.user_document');
        $decript_documentId = decrypt($user_document_encripted);
        $user_document = UserDocument::where('id', $decript_documentId)->get();
        $input_data = $request->all();
        $is_valid = 1;
        if (!empty($input_data["is_document_exist_check"]) && $input_data["is_document_exist_check"] == 1) {
            if (count($user_document) > 0) {
                $filepath = \Storage::disk($fileConfigData['disk'])->path("/" . $fileConfigData['folder'] . "/" . $user_document[0]->file);
                if (!file_exists($filepath)) {
                    $is_valid = 0;
                }
            }
            if ($is_valid == 1) {
                $dataArray = ["status" => true, "message" => "File is exists!"];
            } else {
                $dataArray = ["status" => false, "message" => "File is not exists!"];
            }

            return response()->json($dataArray, (($is_valid == 1) ? 200 : 422));
        }


        $filepath = \Storage::disk($fileConfigData['disk'])->path("/" . $fileConfigData['folder'] . "/" . $user_document[0]->file);
        $ext = pathinfo($filepath, PATHINFO_EXTENSION);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $user_document[0]->name . "." . $ext . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);


        exit();
    }
    public function documentPrint($user_document_encripted)
    {


        $fileConfigData = config('upload_config.user_document');
        $decript_documentId = decrypt($user_document_encripted);
        $user_documentArray = UserDocument::where('id', $decript_documentId)->get();
        if (count($user_documentArray) > 0)
            $user_document = $user_documentArray[0];

        $filepath = \Storage::disk($fileConfigData['disk'])->path("/" . $fileConfigData['folder'] . "/" . $user_document->file);
        $is_valid = 1;
        if (file_exists($filepath)) {
            $fileURL = \Storage::disk($fileConfigData['disk'])->url("public/" . $fileConfigData['folder'] . "/" . $user_document->file);
            $dataArray = ['status' => true, 'message' => 'Document Found successfully.', 'fileurl' => $fileURL];
        } else {
            $dataArray = ['status' => false, 'message' => 'Document not found.'];
            $is_valid = 0;
        }
        return response()->json($dataArray, (($is_valid == 1) ? 200 : 422));
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
            $return_document = [
                "encrypted_id" => $document->encrypted_id,
                "name" => $document->name,
                "thumbnail_url" => $document->thumbnail_url,
                "tags" => $document->tags,
            ];
            $response_type = 'success';
            $response_data = $return_document;
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 404));
    }

    public function saveTags(Request $request)
    {
        $input_data = $request->input();
        $document_id = decrypt($input_data['document'] ?? '');
        $document = UserDocument::dataRow(['id' => $document_id]);
        if (empty($document)) {
            $response_type = 'error';
            $response_message = 'Document not found';
        } else {
            UserDocumentTag::where('user_document_id', $document->id)->delete();
            if (!empty($input_data['tags'])) {
                foreach ($input_data['tags'] as $tags) {
                    $tag_data = [
                        "user_document_id" => $document->id,
                        "name" => $tags['name'],
                        "color" => $tags['color'],
                    ];
                    UserDocumentTag::saveData($tag_data);
                }
            }
            $response_type = 'success';
            $response_message = "Tags save successfully";
        }
        if ($response_type == 'success') {
            set_flash("success", $response_message);
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 404));
    }

    public function smartFolderList()
    {
        $user = Auth::user();
        $data_array = [
            'title' => 'Smart Folders',
        ];
        $data_array['user_tags'] = UserDocumentTag::getUserTagsList($user->id);
        return view('front.user-document.smart-folder-list', $data_array);
    }

    public function getSmartFolderListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $folder_params = [];
        $folder_params['user_id'] = $user->id;
        $folder_params['search_text'] = $input_data['search_text'] ?? null;
        $folders = UserSmartFolder::getFolderList($folder_params);
        $view = View::make('front.user-document.folders-with-checkbox')->with('documents', $folders)->render();
        $count = count($folders);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function saveSmartFolder(SmartFolderFormRequest $request, UserSmartFolder $user_smart_folder)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $input_data['user_id'] = $user->id;
        if (UserSmartFolder::saveData($input_data, $user_smart_folder)) {
            $response_type = 'success';
            $response_message = 'Smart folder saved successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Error occoured, Please try again.';
        }
        set_flash($response_type, $response_message);
        return redirect()->back();
    }

    public function deleteSmartFolder(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $folder_arr = ((!empty($input_data['folders']) && is_array($input_data['folders'])) ? $input_data['folders'] : [($input_data['folders'] ?? '')]);
        $folder_arr = array_filter($folder_arr);
        if (!empty($folder_arr)) {
            UserSmartFolder::where('user_id', $user->id)->whereIn('id', $folder_arr)->delete();
            $response_type = 'success';
            $response_message = 'Smart folder deleted successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Error occoured, Please try again';
        }

        if ($response_type == 'success') {
            set_flash("success", $response_message);
        }
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }

    public function smartFolderDocuments(UserSmartFolder $user_smart_folder)
    {
        $user = Auth::user();
        if ($user_smart_folder->user_id != $user->id) {
            abort(404, "Not found");
        }
        $data_array = [
            'title' => 'Smart Folder (' . $user_smart_folder->name . ')',
        ];
        $data_array["user_smart_folder"] = $user_smart_folder;
        $data_array["footer_menu"] = true;
        return view('front.user-document.smart-folder-document-list', $data_array);
    }

    public function smartFolderDetail(UserSmartFolder $user_smart_folder)
    {
        $user = Auth::user();
        if ($user_smart_folder->user_id != $user->id) {
            abort(404, "Not found");
        }
        $response_data = [
            "name" => $user_smart_folder->name,
            "tags" => $user_smart_folder->tags_arr,
        ];
        return response()->json(array(
            'success' => 'success',
            'data' => $response_data,
        ), 200);
    }

    public function smartFolderDocumentsList(UserSmartFolder $user_smart_folder, Request $request)
    {
        $user = Auth::user();
        if ($user_smart_folder->user_id != $user->id) {
            abort(404);
        }
        $input_data = $request->input();
        $document_params = [];
        $document_params['user_id'] = $user->id;
        $document_params['type'] = config('constant.DOCUMENT_TYPE_FILE');
        $document_params['document_ids'] = $user_smart_folder->user_document_ids;
        $document_params['search_text'] = $input_data['search_text'] ?? null;
        $document_params['order_by'] = $input_data['sort_by'] ?? null;
        $documents = UserDocument::getDocumentList($document_params);
        $view = View::make('front.user-document.items-with-checkbox')->with('documents', $documents)->render();
        $count = count($documents);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function sendViaUsps($user_document, Request $request)
    {
        $user = Auth::user();
        $document_id = decrypt($user_document ?? '');
        $document = UserDocument::dataRow(['id' => $document_id]);
        if (empty($document)) {
            abort(404);
        }
        if ($request->isMethod('post')) {
            $input_data = $request->input();
            $input_data['user_id'] = $user->id;
            $usps_request = UspsRequest::saveData($input_data);
            if ($usps_request) {
                $usps_document = [
                    'usps_request_id' => $usps_request->id,
                    'user_document_id' => $document->id,
                ];
                $usps_request = UspsRequestDocument::saveData($usps_document);
                $response_type = 'success';
                $response_message = 'Usps Request submitted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
            set_flash($response_type, $response_message);
            return redirect()->route('front.dashboard');
        }

        $data_array = [
            'title' => "Send via USPS",
            'document' => $document,
            'delivery_methods' => config('custom_config.usps_delivery_methods'),
            'default_delivery_method' => config('constant.DEFAULT_DELIVERY_METHOD')
        ];
        return view('front.user-document.send-via-usps', $data_array);
    }
}
