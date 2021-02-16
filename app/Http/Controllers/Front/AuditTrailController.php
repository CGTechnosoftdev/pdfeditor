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
        $audit_trash_images = config("custom_config.audit_trash_images");
        $audit_trash_images_class = config("custom_config.audit_trash_images_class");

        $audit_book_items_array = array();
        if (count($audit_book_items) > 0) {
            foreach ($audit_book_items as $audit_index => $audit_item) {
                //  echo '<br> created ' . $audit_item->created_at;
                $icon_file = $audit_trash_images["default"];
                $class = $audit_trash_images_class["default"];
                switch ($audit_item->type) {
                    case 'trash':
                        $icon_file = $audit_trash_images["trash"];
                        $class = $audit_trash_images_class["trash"];
                        break;
                    case 'upload_create':
                        $icon_file = $audit_trash_images["upload_create"];
                        $class = $audit_trash_images_class["upload_create"];
                        break;
                    case 'account':
                        $icon_file = $audit_trash_images["account"];
                        $class = $audit_trash_images_class["account"];
                        break;
                    case 'share':
                        $icon_file = $audit_trash_images["share"];
                        $class = $audit_trash_images_class["share"];
                        break;
                }

                $audit_book_items_array[date("Y-m-d", strtotime($audit_item->created_at))][$audit_item->id]["description"] = $audit_item->description;
                $audit_book_items_array[date("Y-m-d", strtotime($audit_item->created_at))][$audit_item->id]["ip_address"] = $audit_item->ip_address;
                $audit_book_items_array[date("Y-m-d", strtotime($audit_item->created_at))][$audit_item->id]["date"] = $audit_item->created_at;
                $audit_book_items_array[date("Y-m-d", strtotime($audit_item->created_at))][$audit_item->id]["icon_file"] = $icon_file;
                $audit_book_items_array[date("Y-m-d", strtotime($audit_item->created_at))][$audit_item->id]["class"] = $class;
            }
        }

        // exit();
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
    public function getAuditTrailDownload()
    {
        $user = Auth::user();
        $audit_trail_result = AuditTrail::where(["created_by" => $user->id])->orderBy('created_at', 'desc')->get();
        $row_index = 0;
        $audit_CSV[$row_index] = array('Ip', 'Details', 'Date');
        $row_index += 1;
        if (count($audit_trail_result) > 0) {
            foreach ($audit_trail_result as $audit_index => $audit_data) {

                $audit_CSV[$row_index]["Ip"] = $audit_data->ip_address;
                $audit_CSV[$row_index]["Details"] = $audit_data->description;
                $audit_CSV[$row_index]["Date"] = $audit_data->created_at;
                $row_index += 1;
            }
        }
        $delimiter = ";";
        $filename = "AuditTrail.csv";

        $f = fopen('php://memory', 'w');
        // loop over the input array
        foreach ($audit_CSV as $line) {
            // generate csv lines from the inner arrays
            fputcsv($f, $line, $delimiter);
        }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        // make php send the generated csv lines to the browser
        fpassthru($f);

        exit();
    }
}
