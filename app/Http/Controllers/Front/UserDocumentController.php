<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\UserDocumentUploadFormRequest;
use App\Http\Requests\UserDocumentGetFormRequest;
use App\Http\Requests\UserAddFolderFormRequest;
use App\Http\Requests\DocumentRenameFormRequest;

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
        if ($response_type == 'success') {
            set_flash("success", $response_message);
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
                $input_data['name'] = pathinfo($input_data['url'], PATHINFO_FILENAME);
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
