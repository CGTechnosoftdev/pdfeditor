<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Auth, View, Response;
use App\Models\AuditTrail;

class AuditTrailController extends FrontBaseController
{

    public function auditTrailList()
    {
        $data_array = [
            'title' => 'Audit Trail List',

        ];
        return view('front.audit-trail.index', $data_array);
    }
    public function getAuditTrailData(Request $request)
    {
        $user = Auth::user();
        $input_data = $request->all();

        $audit_trail_params = ['users_id' => $user->id];
        $audit_trail_params['search_text'] = $input_data['search_text'] ?? null;
        $audit_book_items = AuditTrail::getAuditTrail($audit_trail_params);

        $audit_book_items_array = array();
        if (count($audit_book_items) > 0) {
            foreach ($audit_book_items as $audit_index => $audit_item) {
                $audit_book_items_array[date_format($audit_item->created_at, "Y-m-d")][$audit_item->id]["description"] = $audit_item->description;
                $audit_book_items_array[date_format($audit_item->created_at, "Y-m-d")][$audit_item->id]["ip_address"] = $audit_item->ip_address;
                $audit_book_items_array[date_format($audit_item->created_at, "Y-m-d")][$audit_item->id]["date"] = $audit_item->created_at;
            }
        }


        $data_array = [
            'title' => 'Address List',
            'audit_trail_items' => $audit_book_items_array,
            'search_text' => $audit_trail_params['search_text'],

        ];

        //->with($data_array) 
        $view = View::make('front.audit-trail.item-list')->with($data_array)->render();
        $count = count($audit_book_items);
        return Response::json(array('html' => $view, 'count' => $count));
    }
}
