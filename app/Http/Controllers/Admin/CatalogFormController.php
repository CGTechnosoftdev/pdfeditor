<?php

namespace App\Http\Controllers\Admin;

use App\Models\CatalogForm;
use App\Models\CatalogFormCategory;
use Illuminate\Http\Request;
use App\Http\Requests\CatalogFormFormRequest;

class CatalogFormController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-11-13
     */
    function __construct()
    {
        $this->middleware('permission:catalog-form-list|catalog-form-create|catalog-form-edit|catalog-form-delete');
        $this->middleware('permission:catalog-form-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:catalog-form-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:catalog-form-delete', ['only' => ['destroy']]);
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }

    public function index(Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = CatalogForm::query()->get();
            $table = Datatables()->of($model);
            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'catalog-form.edit', 'route_param' => [$row->id], 'permission' => 'catalog-form-edit'],
                    'delete' => ['route_url' => 'catalog-form.destroy', 'route_param' => [$row->id], 'permission' => 'catalog-form-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });
            $table->editColumn('catalog_form', function ($row) {
                return '<a href="#" class="show_catalog_form" data-link="' . $row->catalog_form . '" title="View"><i class="fa fa-eye"></i></a>';
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'catalog-form',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'catalog-form-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Catalog Forms',
            'heading' => 'Catalog Forms',
            'breadcrumb' => \Breadcrumbs::render('catalog-form.index'),
            'add_css_heading' => ' add_custom_button_heading',
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Catalog Form',
            'link'    => route('catalog-form.create'),
            'permission' => 'catalog-form-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('catalog-form.index'),
            'data_column_config' => config('datatable_column.catalog-form'),
        ];
        return view('admin.catalog-form.index', $data_array);
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
            'title' => 'Add Catalog Form',
            'heading' => 'Add Catalog Form',
            'breadcrumb' => \Breadcrumbs::render('catalog-form.create'),
        ];
        $data_array['category_arr'] = CatalogFormCategory::getCategoryListArr();
        return view('admin.catalog-form.form', $data_array);
    }

    public function store(CatalogFormFormRequest $request)
    {
        try {
            $input_data = $request->input();
            if (!empty($request->file('form'))) {
                $upload_response = uploadFile($request, 'catalog_form');
                if (!empty($upload_response['success'])) {
                    $input_data['form'] = $upload_response['data'];
                }
            }
            $catalog_form = CatalogForm::saveData($input_data);
            if ($catalog_form) {
                $response_type = 'success';
                $response_message = 'Catalog form added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('catalog-form.index');
    }

    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  CatalogForm       $catalog_form [description]
     * @return [type]           [description]
     */
    public function edit(CatalogForm $catalog_form)
    {
        $data_array = [
            'title' => 'Edit Catalog Form',
            'heading' => 'Edit Catalog Form',
            'breadcrumb' => \Breadcrumbs::render('catalog-form.edit', ['id' => $catalog_form->id]),
            'catalog_form' => $catalog_form
        ];
        $data_array['category_arr'] = CatalogFormCategory::getCategoryListArr();
        return view('admin.catalog-form.form', $data_array);
    }

    /**
     * [update description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  CatalogFormFormRequest $request [description]
     * @param  CatalogForm             $catalog_form    [description]
     * @return [type]                    [description]
     */
    public function update(CatalogFormFormRequest $request, CatalogForm $catalog_form)
    {
        try {
            $input_data = $request->input();
            $catalog_form = CatalogForm::saveData($input_data, $catalog_form);
            if ($catalog_form) {
                $response_type = 'success';
                $response_message = 'Catalog form edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('catalog-form.index');
    }

    /**
     * [destroy description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  CatalogForm       $catalog_form [description]
     * @return [type]           [description]
     */
    public function destroy(CatalogForm $catalog_form)
    {
        try {
            if ($catalog_form->delete()) {
                $response_type = 'success';
                $response_message = 'Catalog form deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('catalog-form.index');
    }
}
