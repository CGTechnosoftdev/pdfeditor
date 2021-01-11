<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Trash;
use App\Models\UserDocument;

class TrashController extends FrontBaseController
{
    public function getTrashList()
    {
        $data_array = [
            'title' => 'Trash',
        ];
        $trashListArray = Trash::getTrashList();;

        $data_array['trash_items'] = Trash::getTrashList();
        return view('front.trash', $data_array);
    }
    public function trashUpdate(Request $request)
    {
        $dataArray = $request->all();
        // dd($dataArray);
        $req_type = $dataArray["req_type"];
        $is_valid = 1;
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
        set_flash($response_type, $response_message);
        return redirect()->route("front.get-trash-list");
    }
    public function trashEmpty()
    {
        if (Trash::emptyTrashList()) {
            $response_type = 'success';
            $response_message = 'Trash List Empty successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Trash List not empty.';
        }
        set_flash($response_type, $response_message);
        return redirect()->route("front.get-trash-list");
    }
}
