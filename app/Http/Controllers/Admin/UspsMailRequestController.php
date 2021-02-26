<?php

namespace App\Http\Controllers\Admin;

use App\Models\UspsRequest;

use App\Models\UspsMailStatus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\BusinessCategoryFormRequest;
use App\Http\Requests\UspsMailStatusRequestFormRequest;
use App\Models\UspsRequestDocument;

class UspsMailRequestController extends AdminBaseController
{
    function __construct()
    {

        $this->middleware('permission:usps-mail-request-list|usps-mail-request-create|usps-mail-request-edit|usps-mail-request-delete');
        $this->middleware('permission:usps-mail-request-view', ['only' => ['view']]);
        $this->middleware('permission:usps-mail-request-update', ['only' => ['updateStatus']]);
        $this->middleware('permission:usps-mail-request-status-edit', ['only' => ['getStatus']]);
        $this->middleware('permission:usps-mail-request-add-status', ['only' => ['addStatus']]);
    }
    public function index(Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';

            $model = UspsRequest::query()->with('getUspsRequestUser');
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->addColumn('request_by', '');


            $table->editColumn('created_at', function ($row) use ($action_button_template) {

                return changeDateTimeFormat($row->created_at);
            });

            $table->editColumn('request_by', function ($row) use ($action_button_template) {

                return $row->getUspsRequestUser->first_name . " " . $row->getUspsRequestUser->last_name;
            });


            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'view' => ['route_url' => 'usps-mail-request.view', 'route_param' => [$row->id], 'permission' => 'permission:usps-mail-request-view'],

                ];
                return view($action_button_template, compact('buttons'));
            });

            /*  
            'update_status' => ['route_url' => 'usps-mail-request-list-status', 'label' => '', 'route_param' => [$row->id], 'permission' => 'permission:usps-mail-request-list-status'],
            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'usps-request',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'usps-mail-request-update-status'
                ];
                return view($status_button_template, compact('button_data'));
            }); */

            return $table->make(true);
        }
        $data_array = [
            'title' => 'Usps Request',
            'heading' => 'Manage USPS Request',
            'breadcrumb' => \Breadcrumbs::render('usps-mail-request.list'),
        ];

        $data_array['data_table'] = [
            'data_source' => route('usps-mail-request.list'),
            'data_column_config' => config('datatable_column.usps-request'),
        ];
        return view('admin.usps-mail-request.index', $data_array);
    }
    public function uspsView(UspsRequest $usps_request)
    {
        $yes_no_arr = config("custom_config.yes_no_arr");
        $usps_delivery_methods = config("custom_config.usps_delivery_methods");
        $usps_request_status = config('custom_config.usps_request_status');

        $usps_entered_status = UspsMailStatus::query()->where("usps_requests_id", $usps_request->id)->orderBy('created_at', 'DESC')->get();
        $request_user = UspsRequest::query()->with('getUspsRequestUser')->where('user_id', $usps_request->user_id)->first();


        $data_array = [
            'title' => 'View USPS Mail Request',
            'heading' => 'View USPS Mail Request',
            'usps_request' => $usps_request,
            'yes_no_arr' => $yes_no_arr,
            'usps_delivery_methods' => $usps_delivery_methods,
            'usps_request_status' => $usps_request_status,
            'usps_entered_status' => $usps_entered_status,
            'request_user' => $request_user,
        ];

        $data_array['back_button'] = [
            'label' => 'Back',
            'link'  => route('usps-mail-request.list'),
        ];
        $data_array['back_button'] = [
            'label' => 'Back',
            'link'  => route('usps-mail-request.list'),
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Status',
            'id' => 'add_new_status_button_id',
            'link'    => "#",
            'permission' => 'usps-mail-request-add-status',
        ];
        return view('admin.usps-mail-request.view', $data_array);
    }

    public function newStatusSave(UspsRequest $usps_request, UspsMailStatusRequestFormRequest $request)
    {
        $input_all = $request->all();

        try {

            $input_data = $request->input();

            $businessCategory = UspsMailStatus::saveData($input_data);

            if ($businessCategory) {
                $response_type = 'success';
                $response_message = 'Usps mail request status added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('usps-mail-request.view', [$usps_request->id]);
    }

    /* 
     public function addStatus(UspsRequest $usps_request)
    {

        $usps_request_status = config('custom_config.usps_request_status');
        //'breadcrumb' => \Breadcrumbs::render('usps-mail-request-list-status'), 
        $data_array = [
            'title' => 'Add Usps Status',
            'heading' => 'Add Usps Status',
            'usps_request' => $usps_request,
            'usps_request_status' => $usps_request_status,

        ];
        return view('admin.usps-mail-request.form', $data_array);
    }
    public function statusList(UspsRequest $usps_request, Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = UspsMailStatus::query();
            $model->where(['usps_requests_id' => $usps_request->id]);

            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->addColumn('action', '');

            $table->editColumn('mail_status', function ($row) use ($action_button_template) {
                $usps_request_status = config('custom_config.usps_request_status');
                return $usps_request_status[$row->mail_status];
            });
            $table->editColumn('action', function ($row) use ($action_button_template, $usps_request) {
                $buttons = [
                    'edit' => ['route_url' => 'usps-mail-request-get-status', 'route_param' => [$usps_request->id, $row->id], 'permission' => 'permission:usps-mail-request-status-edit'],
                    'delete' => ['route_url' => 'usps-mail-request-delete-status', 'label' => '', 'route_param' => [$usps_request->id, $row->id], 'permission' => 'usps-mail-request-status-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'usps-request-status',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'usps-mail-request-status-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });



            return $table->make(true);
        }


        $uspsRequestDocuments = UspsRequestDocument::query()->with('uspsDocuments')->where("usps_request_id", $usps_request->id)->first();
        $requestUser = UspsRequest::query()->with('getUspsRequestUser')->where('user_id', $usps_request->user_id)->first();

        $data_array = [
            'title' => 'Usps Request Status',
            'heading' => 'Manage Usps Request for ' . $uspsRequestDocuments->uspsDocuments->name . " by " . $requestUser->getUspsRequestUser->first_name . " " . $requestUser->getUspsRequestUser->last_name,
            'breadcrumb' => \Breadcrumbs::render('usps-mail-request.list'),
        ];

        $data_array['data_table'] = [
            'data_source' => route('usps-mail-request-list-status', $usps_request->id),
            'data_column_config' => config('datatable_column.usps-request-status'),
        ];
        $data_array['back_button'] = [
            'label' => 'Back',
            'link'  => route('usps-mail-request.list'),
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Status',
            'link'    => route('usps-mail-request-add-status-get', $usps_request->id),
            'permission' => 'usps-mail-request-add-status',
        ];

        return view('admin.usps-mail-request.status-list', $data_array);
    }
    public function getStatus(UspsRequest $usps_request, UspsMailStatus $usps_mail_status)
    {

        $usps_request_status = config('custom_config.usps_request_status');

        // 'breadcrumb' => \Breadcrumbs::render('usps-mail-request-list-status'), 
        $data_array = [
            'title' => 'Add Usps Status',
            'heading' => 'Add Usps Status',
            'usps_request' => $usps_request,
            'usps_request_status' => $usps_request_status,
            'usps_mail_status' => $usps_mail_status,
        ];
        return view('admin.usps-mail-request.form', $data_array);
    }
    public function statusSave(UspsRequest $usps_request, UspsMailStatus $usps_mail_status, UspsMailStatusRequestFormRequest $request)
    {

        try {
            $input_data = $request->input();


            $top_100_form = UspsMailStatus::saveData($input_data, $usps_mail_status);

            if ($top_100_form) {
                $response_type = 'success';
                $response_message = 'USPS Status edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('usps-mail-request-list-status', [$usps_request->id]);
    }
    public function deleteStatus(UspsRequest $usps_request, UspsMailStatus $usps_mail_status)
    {
        try {

            $usps_mail_status->delete();
            $response_type = 'success';
            $response_message = 'USPS Mail Status deleted successfully';
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('usps-mail-request-list-status', [$usps_request->id]);
    }*/
}
