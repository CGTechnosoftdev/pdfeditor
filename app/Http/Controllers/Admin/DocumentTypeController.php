<?php

namespace App\Http\Controllers\Admin;

use App\Models\DocumentType;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\DocumentTypeFormRequest;

class DocumentTypeController extends AdminBaseController
{
    function __construct()
    {
        $this->middleware('permission:document-type-list|document-type-create|document-type-edit|document-type-delete');
        $this->middleware('permission:document-type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:document-type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:document-type-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = DocumentType::query()->with('documentTemplates')->get();
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->editColumn('uploaded_documents_count', function ($row) {
                return $row->documentTemplates->count() ?? 0;
            });
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'document-type.edit', 'route_param' => [$row->id], 'permission' => 'document-type-edit'],
                    'delete' => ['route_url' => 'document-type.destroy', 'route_param' => [$row->id], 'permission' => 'document-type-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'document_type',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'document-type-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Document Type',
            'heading' => 'Manage Document Type',
            'breadcrumb' => \Breadcrumbs::render('document-type.index'),
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Document Type',
            'link'    => route('document-type.create'),
            'permission' => 'document-type-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('document-type.index'),
            'data_column_config' => config('datatable_column.document-type'),
        ];

        return view('admin.document-type.index', $data_array);
    }

    public function create()
    {
        $data_array = [
            'title' => 'Add Document Type',
            'heading' => 'Add Document Type',
            'breadcrumb' => \Breadcrumbs::render('document-type.create'),
        ];
        return view('admin.document-type.form', $data_array);
    }


    public function store(DocumentTypeFormRequest $request)
    {
        try {
            $input_data = $request->input();
            $document_type = DocumentType::saveData($input_data);
            if ($document_type) {
                $response_type = 'success';
                $response_message = 'Document Type added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('document-type.index');
    }

    public function edit(DocumentType $document_type)
    {
        $data_array = [
            'title' => 'Edit Document Type',
            'heading' => 'Edit Document Type',
            'breadcrumb' => \Breadcrumbs::render('document-type.edit', ['id' => $document_type->id]),
            'document_type' => $document_type
        ];
        return view('admin.document-type.form', $data_array);
    }


    public function update(DocumentTypeFormRequest $request, DocumentType $document_type)
    {
        try {
            $input_data = $request->input();
            $document_type = DocumentType::saveData($input_data, $document_type);
            if ($document_type) {
                $response_type = 'success';
                $response_message = 'Document Type edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('document-type.index');
    }

    public function destroy(DocumentType $document_type)
    {
        try {
            if ($document_type->delete()) {
                $response_type = 'success';
                $response_message = 'Document Type deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('document-type.index');
    }
}
