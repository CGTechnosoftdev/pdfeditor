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
                        $user_document = UserDocument::find($trash_id);

                        if (!$user_document->delete()) {
                            $is_valid = 0;
                        }
                    }
                    if ($is_valid == 1) {
                        $response_type = 'success';
                        $response_message = 'Item deleted successfully';
                    } else {
                        $response_type = 'error';
                        $response_message = 'Item not deleted successfully';
                    }
                }
            } else if ($req_type == config('constant.RESTORE_FORM')) {
                if (!empty($dataArray["trash_items"])) {
                    foreach ($dataArray["trash_items"] as $trash_id => $trash_value) {
                        $user_document = UserDocument::find($trash_id);
                        //   dd($user_document);
                        if (!UserDocument::whereId($trash_id)->update(['trash' => config('constant.NOT_TRASHED')])) {
                            $is_valid = 0;
                        }
                    }

                    if ($is_valid == 1) {
                        $response_type = 'success';
                        $response_message = 'Item restore successfully';
                    } else {
                        $response_type = 'error';
                        $response_message = 'Item not sestore successfully';
                    }
                }
            }
        }
        set_flash($response_type, $response_message);
        return redirect()->route("front.trash-list");
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
        $input_data = $request->all();
        if ($input_data["req_type"] == "move_to_trash") {
            $is_valid = 1;
            $document_id = decryptData($input_data["document_id"]);

            if (!UserDocument::whereId($document_id)->update(['trash' => config('constant.TRASHED')])) {
                $is_valid = 0;
            }
        }
        if ($is_valid == 1) {
            $response_type = 'success';
            $response_message = 'Document move to trash successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Document move to trash failed!';
        }

        set_flash($response_type, $response_message);
        return Response::json(array('response_type' => $response_type, 'response_message' => $response_message));
    }
}
