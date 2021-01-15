<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\UserDocument;
use Auth, Response;

class TrashController extends FrontBaseController
{
    public function getTrashList(Request $request)
    {
        $input_data = $request->all();
        $user = Auth::user();
        $document_params = [];
        $document_params['user_id'] = $user->id;
        $document_params['trash'] = true;
        $document_params['search_text'] = $input_data['search_text'] ?? null;

        $trash_items = UserDocument::getDocumentList($document_params);


        //dd($trash_items);

        $data_array = [
            'title' => 'Trash',
            'trash_items' => $trash_items,
            'trash_count' => count($trash_items),
            'search_text' => $document_params['search_text'],
        ];
        return view('front.trash', $data_array);
    }

    public function trashUpdate(Request $request)
    {
        $dataArray = $request->all();

        $req_type = $dataArray["req_type"];
        $is_valid = 1;

        if (empty($dataArray["trash_items"])) {
            $response_type = 'error';
            $operation = "Restore";
            if ($req_type == config('constant.DESTROY_FORM'))
                $operation = "Delete";
            $response_message = 'Please check atleast one item before ' . $operation;
        } else {

            if ($req_type == config('constant.DESTROY_FORM')) {
                if (!empty($dataArray["trash_items"])) {
                    foreach ($dataArray["trash_items"] as $trash_id => $trash_value) {
                        $trash_id = decrypt($trash_id);
                        $user_document = UserDocument::find($trash_id);

                        if (!$user_document->delete()) {
                            $is_valid = 0;
                        }
                    }
                    if ($is_valid == 1) {
                        $response_type = 'success';
                        $response_message = 'Document deleted successfully';
                    } else {
                        $response_type = 'error';
                        $response_message = 'Document not deleted successfully';
                    }
                }
            } else if ($req_type == config('constant.RESTORE_FORM')) {
                if (!empty($dataArray["trash_items"])) {
                    foreach ($dataArray["trash_items"] as $trash_id => $trash_value) {
                        $trash_id = decrypt($trash_id);
                        $user_document = UserDocument::find($trash_id);
                        //   dd($user_document);
                        if (!$this->restoreOperation($trash_id)) {
                            $is_valid = 0;
                        }
                    }

                    if ($is_valid == 1) {
                        $response_type = 'success';
                        $response_message = 'Document restore successfully';
                    } else {
                        $response_type = 'error';
                        $response_message = 'Document not restore successfully';
                    }
                }
            }
        }
        set_flash($response_type, $response_message);
        return redirect()->route("front.trash-list");
    }
    public function restoreOperation($trash_id)
    {
        return UserDocument::whereId($trash_id)->update(['trash' => config('constant.NOT_TRASHED')]);
    }
    public function trashSingleRestore(Request $request)
    {
        $input_data = $request->all();
        $user_document_encripted = $input_data["user_document_encripted"];
        $decript_documentId = decrypt($user_document_encripted);
        $user_documentArray = UserDocument::where('id', $decript_documentId)->get();
        if (count($user_documentArray) > 0)
            $user_document = $user_documentArray[0];
        $is_valid = 1;
        if (!$this->restoreOperation($decript_documentId)) {
            $is_valid = 0;
        }
        if ($is_valid == 1) {
            $response_type = 'success';
            $response_message = 'Document restore successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Document not restore successfully';
        }
        set_flash($response_type, $response_message);
        return response()->json(array(
            'success' => ($response_type == 'success') ? true : false,
            'message' => $response_message ?? '',
            'data' => $response_data ?? '',
        ), (($response_type == 'success') ? 200 : 422));
    }
    public function trashEmpty()
    {

        if (UserDocument::emptyTrashList()) {
            $response_type = 'success';
            $response_message = 'Trash List Empty successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Trash List already empty.';
        }


        set_flash($response_type, $response_message);
        return redirect()->route("front.trash-list");
    }

    public function moveToTrash(Request $request)
    {
        $input_data = $request->input();
        $document_arr = ((!empty($input_data['document']) && is_array($input_data['document'])) ? $input_data['document'] : [($input_data['document'] ?? '')]);
        $document_arr = array_map(function ($item) {
            return decrypt($item ?? '');
        }, $document_arr);
        $document_arr = array_filter($document_arr);
        if (!empty($document_arr)) {
            UserDocument::whereIn('id', $document_arr)->update(['trash' => config('constant.TRASHED')]);
            $response_type = 'success';
            $response_message = 'Move to trash successfully';
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
}
