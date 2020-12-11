<?php

namespace App\Http\Controllers\Admin;

use App\Models\LegalForm;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\LegalFormFormRequest;

class LegalFormController extends AdminBaseController
{
    function __construct()
    {
        $this->middleware('permission:360-legal-form-list|360-legal-form-create|360-legal-form-edit|360-legal-form-delete');
        $this->middleware('permission:360-legal-form-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:360-legal-form-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:360-legal-form-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = LegalForm::query()->get();
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->editColumn('form_url', function ($row) {
                return "<a href='" . $row->form_url . "' target='_blank'><i class='fa fa-file-pdf-o'></i></a>";
            });
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'legal-form.edit', 'route_param' => [$row->id], 'permission' => '360-legal-form-edit'],
                    'delete' => ['route_url' => 'legal-form.destroy', 'route_param' => [$row->id], 'permission' => '360-legal-form-delete'],
                    'view' => ['route_url' => 'legal-form.show', 'route_param' => [$row->id]],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'legal_form',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => '360-legal-form-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => '360 Legal Forms',
            'heading' => 'Manage 360 Legal Forms',
            'breadcrumb' => \Breadcrumbs::render('legal-form.index'),
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add 360 Legal Form',
            'link'    => route('legal-form.create'),
            'permission' => '360-legal-form-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('legal-form.index'),
            'data_column_config' => config('datatable_column.360-legal-form'),
        ];

        return view('admin.legal-form.index', $data_array);
    }

    public function create()
    {
        $data_array = [
            'title' => 'Add 360 Legal Form',
            'heading' => 'Add 360 Legal Form',
            'breadcrumb' => \Breadcrumbs::render('legal-form.create'),
        ];
        return view('admin.legal-form.form', $data_array);
    }


    public function store(LegalFormFormRequest $request)
    {
        try {
            $input_data = $request->input();
            if (!empty($request->file('form'))) {
                $upload_response = uploadFile($request, '360_legal_form');
                if (!empty($upload_response['success'])) {
                    $input_data['form'] = $upload_response['data'];
                }
            }
            $legal_form = LegalForm::saveData($input_data);
            if ($legal_form) {
                $response_type = 'success';
                $response_message = '360 Legal Form added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('legal-form.index');
    }

    public function edit(LegalForm $legal_form)
    {
        $data_array = [
            'title' => 'Edit 360 Legal Form',
            'heading' => 'Edit 360 Legal Form',
            'breadcrumb' => \Breadcrumbs::render('legal-form.edit', ['id' => $legal_form->id]),
            'legal_form' => $legal_form,
        ];
        return view('admin.legal-form.form', $data_array);
    }


    public function update(LegalFormFormRequest $request, LegalForm $legal_form)
    {
        try {
            $input_data = $request->input();
            if (!empty($request->file('form'))) {
                $upload_response = uploadFile($request, '360_legal_form');
                if (!empty($upload_response['success'])) {
                    $input_data['form'] = $upload_response['data'];
                }
            }
            $legal_form = LegalForm::saveData($input_data, $legal_form);
            if ($legal_form) {
                $response_type = 'success';
                $response_message = '360 Legal Form edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('legal-form.index');
    }

    /**
     * [show description]
     * @author Akash Sharma
     * @date   2020-11-02
     * @param  LegalForm       $legal_form [description]
     * @return [type]                [description]
     */
    public function show(LegalForm $legal_form)
    {
        $data_array = [
            'title' => $legal_form->name . " Detail",
            'heading' => $legal_form->name . " Detail",
            'breadcrumb' => \Breadcrumbs::render('legal-form.show', $legal_form->id, $legal_form->name),
            'legal_form' => $legal_form
        ];
        $data_array['back_button'] = [
            'label' => 'Back',
            'link'  => route('legal-form.index'),
        ];
        return view('admin.legal-form.view', $data_array);
    }

    public function destroy(LegalForm $legal_form)
    {
        try {
            if ($legal_form->delete()) {
                $response_type = 'success';
                $response_message = '360 Legal Form deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('legal-form.index');
    }
}
