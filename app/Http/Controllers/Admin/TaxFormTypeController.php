<?php

namespace App\Http\Controllers\Admin;

use App\Models\TaxFormType;
use Illuminate\Http\Request;
use App\Http\Requests\TaxFormTypeFormRequest;

class TaxFormTypeController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-11-13
     */
    function __construct()
    {
        $this->middleware('permission:tax-type-list|tax-type-create|tax-type-edit|tax-type-delete');
        $this->middleware('permission:tax-type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tax-type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tax-type-delete', ['only' => ['destroy']]);
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }

    public function index(Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = TaxFormType::query()->get();
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'tax-type.edit', 'route_param' => [$row->id], 'permission' => 'tax-type-edit'],
                    'delete' => ['route_url' => 'tax-type.destroy', 'route_param' => [$row->id], 'permission' => 'tax-type-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'tax-type',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'tax-type-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Tax Types',
            'heading' => 'Tax Types',
            'breadcrumb' => \Breadcrumbs::render('tax-type.index'),
            'add_css_heading' => ' add_custom_button_heading',
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Tax Type',
            'link'    => route('tax-type.create'),
            'permission' => 'tax-type-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('tax-type.index'),
            'data_column_config' => config('datatable_column.tax-type'),
        ];
        return view('admin.tax-type.index', $data_array);
    }


    /**
     * [create description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @return [type]     [description]
     */
    public function create()
    {
        $data_array = [
            'title' => 'Add Tax Type',
            'heading' => 'Add Tax Type',
            'breadcrumb' => \Breadcrumbs::render('tax-type.create'),
        ];
        return view('admin.tax-type.form', $data_array);
    }

    public function store(TaxFormTypeFormRequest $request)
    {
        try {
            $input_data = $request->input();
            $tax_type = TaxFormType::saveData($input_data);
            if ($tax_type) {
                $response_type = 'success';
                $response_message = 'Tax type added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-type.index');
    }

    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxFormType       $tax_type [description]
     * @return [type]           [description]
     */
    public function edit(TaxFormType $tax_type)
    {
        $data_array = [
            'title' => 'Edit Tax Type',
            'heading' => 'Edit Tax Type',
            'breadcrumb' => \Breadcrumbs::render('tax-type.edit', ['id' => $tax_type->id]),
            'tax_type' => $tax_type
        ];
        return view('admin.tax-type.form', $data_array);
    }

    /**
     * [update description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxFormTypeFormRequest $request [description]
     * @param  TaxFormType             $tax_type    [description]
     * @return [type]                    [description]
     */
    public function update(TaxFormTypeFormRequest $request, TaxFormType $tax_type)
    {
        try {
            $input_data = $request->input();
            $tax_type = TaxFormType::saveData($input_data, $tax_type);
            if ($tax_type) {
                $response_type = 'success';
                $response_message = 'Tax type edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-type.index');
    }

    /**
     * [destroy description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxFormType       $tax_type [description]
     * @return [type]           [description]
     */
    public function destroy(TaxFormType $tax_type)
    {
        try {
            if ($tax_type->taxCategory->count() > 0) {
                $response_type = 'error';
                $response_message = 'Unable to delete, Linked tax category exist';
            } elseif ($tax_type->delete()) {
                $response_type = 'success';
                $response_message = 'Tax type deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-type.index');
    }
}
