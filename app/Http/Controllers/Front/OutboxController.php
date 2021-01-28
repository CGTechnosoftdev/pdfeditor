<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\UspsRequest;
use App\Models\SharedDocument;
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

    public function uspsMailListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $params = [];
        $params['user_id'] = $user->id;
        $params['search_text'] = $input_data['search_text'] ?? null;
        $params['order_by'] = $input_data['sort_by'] ?? null;

        $items = UspsRequest::getRequestList($params);
        $view = View::make('front.outbox.usps-mail-item')->with('items', $items)->render();
        $count = count($items);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function uspsMailDelete(Request $request)
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

    public function shareList()
    {
        $user = Auth::user();
        $data_array = [
            'title' => 'Share',
        ];
        return view('front.outbox.share-list', $data_array);
    }

    public function shareListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $params = [];
        $params['user_id'] = $user->id;
        $params['share_method'] = config('constant.SHARE_METHOD_SHARE');
        $params['search_text'] = $input_data['search_text'] ?? null;
        $params['order_by'] = $input_data['sort_by'] ?? null;

        $items = SharedDocument::getSharedList($params);
        $view = View::make('front.outbox.share-item')->with('items', $items)->render();
        $count = count($items);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function shareDelete(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $items_arr = ((!empty($input_data['items']) && is_array($input_data['items'])) ? $input_data['items'] : [($input_data['items'] ?? '')]);
        if (!empty($items_arr)) {
            SharedDocument::whereIn('id', $items_arr)->where(['user_id' => $user->id])->delete();
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

    public function shareStopSharing(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $items_arr = ((!empty($input_data['items']) && is_array($input_data['items'])) ? $input_data['items'] : [($input_data['items'] ?? '')]);
        if (!empty($items_arr)) {
            SharedDocument::whereIn('id', $items_arr)->where(['user_id' => $user->id])->update(['status' => config('constant.STATUS_INACTIVE')]);
            $response_type = 'success';
            $response_message = 'Sharing stopped successfully';
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

    public function sendForReviewList()
    {
        $user = Auth::user();
        $data_array = [
            'title' => 'Send for Review',
        ];
        return view('front.outbox.send-for-review-list', $data_array);
    }

    public function sendForReviewListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $params = [];
        $params['user_id'] = $user->id;
        $params['share_method'] = config('constant.SHARE_METHOD_SENDFORREVIEW');
        $params['search_text'] = $input_data['search_text'] ?? null;
        $params['order_by'] = $input_data['sort_by'] ?? null;

        $items = SharedDocument::getSharedList($params);
        $view = View::make('front.outbox.send-for-review-item')->with('items', $items)->render();
        $count = count($items);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function sendForReviewDelete(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $items_arr = ((!empty($input_data['items']) && is_array($input_data['items'])) ? $input_data['items'] : [($input_data['items'] ?? '')]);
        if (!empty($items_arr)) {
            SharedDocument::whereIn('id', $items_arr)->where(['user_id' => $user->id])->delete();
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

    public function sendForReviewStopSharing(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $items_arr = ((!empty($input_data['items']) && is_array($input_data['items'])) ? $input_data['items'] : [($input_data['items'] ?? '')]);
        if (!empty($items_arr)) {
            SharedDocument::whereIn('id', $items_arr)->where(['user_id' => $user->id])->update(['status' => config('constant.STATUS_INACTIVE')]);
            $response_type = 'success';
            $response_message = 'Sharing stopped successfully';
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


    public function linkToFillList()
    {
        $user = Auth::user();
        $data_array = [
            'title' => 'Link to Fill',
        ];
        return view('front.outbox.link-to-fill-list', $data_array);
    }

    public function linkToFillListData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $params = [];
        $params['user_id'] = $user->id;
        $params['share_method'] = config('constant.SHARE_METHOD_LINKTOFILL');
        $params['search_text'] = $input_data['search_text'] ?? null;
        $params['order_by'] = $input_data['sort_by'] ?? null;

        $items = SharedDocument::getSharedList($params);
        $view = View::make('front.outbox.link-to-fill-item')->with('items', $items)->render();
        $count = count($items);
        return Response::json(array('html' => $view, 'count' => $count));
    }

    public function linkToFillDelete(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->input();
        $items_arr = ((!empty($input_data['items']) && is_array($input_data['items'])) ? $input_data['items'] : [($input_data['items'] ?? '')]);
        if (!empty($items_arr)) {
            SharedDocument::whereIn('id', $items_arr)->where(['user_id' => $user->id])->delete();
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
