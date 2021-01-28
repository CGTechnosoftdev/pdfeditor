<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\UspsRequest;
use DB, Auth, View, Response;

class OutboxController extends FrontBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function uspsMailList()
    {
        $user = Auth::user();
        $data_array = [
            'title' => 'USPS Mail',
        ];
        return view('front.outbox.usps-list', $data_array);
    }

    public function getUspsMailListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $document_params = [];
        $document_params['user_id'] = $user->id;
        $document_params['search_text'] = $input_data['search_text'] ?? null;
        $document_params['order_by'] = $input_data['sort_by'] ?? null;

        $documents = UspsRequest::getRequestList($document_params);
        $view = View::make('front.outbox.usps-mail-item')->with('documents', $documents)->render();
        $count = count($documents);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function deleteUspsRequest(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $request_arr = ((!empty($input_data['requests']) && is_array($input_data['requests'])) ? $input_data['requests'] : [($input_data['requests'] ?? '')]);
        if (!empty($request_arr)) {
            UspsRequest::whereIn('id', $request_arr)->where(['user_id' => $user->id])->delete();
            $response_type = 'success';
            $response_message = 'Deleted successfully';
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
