<?php

namespace App\Http\Controllers\Admin;

use App\Models\DocumentTemplate;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\DocumentTemplateFormRequest;

class DocumentTemplateController extends AdminBaseController
{
    function __construct()
    {
        $this->middleware('permission:document-template-list|document-template-create|document-template-edit|document-template-delete');
        $this->middleware('permission:document-template-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:document-template-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:document-template-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = DocumentTemplate::query()->get();
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->editColumn('template_file_url', function ($row) {
                return "<a href='" . $row->template_file_url . "' target='_blank'><i class='fa fa-file-pdf-o'></i></a>";
            });
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'document-template.edit', 'route_param' => [$row->id], 'permission' => 'document-template-edit'],
                    'delete' => ['route_url' => 'document-template.destroy', 'route_param' => [$row->id], 'permission' => 'document-template-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'document_template',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'document-template-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Document Template',
            'heading' => 'Manage Document Template',
            'breadcrumb' => \Breadcrumbs::render('document-template.index'),
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Document Template',
            'link'    => route('document-template.create'),
            'permission' => 'document-template-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('document-template.index'),
            'data_column_config' => config('datatable_column.document-template'),
        ];

        return view('admin.document-template.index', $data_array);
    }

    public function create()
    {
        $document_row_results = DocumentType::select('id', 'name')
            ->where(['status' => config("constant.STATUS_ACTIVE")])
            ->get()->toArray();
        $document_type_list = array("" => "--Select--");
        if (!empty($document_row_results)) {
            foreach ($document_row_results as $index => $result_data_array) {
                $document_type_list[$result_data_array["id"]] = $result_data_array["name"];
            }
            $document_type_list = $document_type_list;
        }

        $data_array = [
            'title' => 'Add Document Template',
            'heading' => 'Add Document Template',
            'breadcrumb' => \Breadcrumbs::render('document-template.create'),
            'document_type_list' => $document_type_list,
        ];
        return view('admin.document-template.form', $data_array);
    }


    public function store(DocumentTemplateFormRequest $request)
    {
        try {
            $input_data = $request->input();

            if (!empty($request->file('template_file'))) {
                $upload_response = uploadFile($request, 'template_file');
                if (!empty($upload_response['success'])) {
                    $input_data['template_file'] = $upload_response['data'];
                }
            }

            $document_template = DocumentTemplate::saveData($input_data);
            if ($document_template) {
                $response_type = 'success';
                $response_message = 'Document Template added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('document-template.index');
    }

    public function edit(DocumentTemplate $document_template)
    {
        $document_row_results = DocumentType::select('id', 'name')
            ->where(['status' => config("constant.STATUS_ACTIVE")])
            ->get()->toArray();
        $document_type_list = array("" => "--Select--");
        if (!empty($document_row_results)) {
            foreach ($document_row_results as $index => $result_data_array) {
                $document_type_list[$result_data_array["id"]] = $result_data_array["name"];
            }
            $document_type_list = $document_type_list;
        }

        $data_array = [
            'title' => 'Edit Document Template',
            'heading' => 'Edit Document Template',
            'breadcrumb' => \Breadcrumbs::render('document-template.edit', ['id' => $document_template->id]),
            'document_template' => $document_template,
            'document_type_list' => $document_type_list,
        ];
        return view('admin.document-template.form', $data_array);
    }


    public function update(DocumentTemplateFormRequest $request, DocumentTemplate $document_template)
    {
        try {
            $input_data = $request->input();
            if (empty($input_data["is_popular"]))
                $input_data["is_popular"] = 0;
            if (!empty($request->file('template_file'))) {
                $upload_response = uploadFile($request, 'template_file');
                if (!empty($upload_response['success'])) {
                    $input_data['template_file'] = $upload_response['data'];
                }
            }

            $document_template = DocumentTemplate::saveData($input_data, $document_template);
            if ($document_template) {
                $response_type = 'success';
                $response_message = 'Document Template edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('document-template.index');
    }

    public function destroy(DocumentTemplate $document_template)
    {
        try {
            if ($document_template->delete()) {
                $response_type = 'success';
                $response_message = 'Document Template deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('document-template.index');
    }
}
