<?php

namespace App\Http\Controllers\Admin;

use App\Models\TaxFormCategory;
use Illuminate\Http\Request;
use App\Http\Requests\TaxFormCategoryFormRequest;
use App\Models\TaxFormType;

class TaxFormCategoryController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-11-13
     */
    function __construct()
    {
        $this->middleware('permission:tax-category-list|tax-category-create|tax-category-edit|tax-category-delete');
        $this->middleware('permission:tax-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tax-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tax-category-delete', ['only' => ['destroy']]);
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }

    public function index(Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = TaxFormCategory::query()->get();
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'tax-category.edit', 'route_param' => [$row->id], 'permission' => 'tax-category-edit'],
                    'delete' => ['route_url' => 'tax-category.destroy', 'route_param' => [$row->id], 'permission' => 'tax-category-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'tax-category',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'tax-category-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Tax Category',
            'heading' => 'Tax Category',
            'breadcrumb' => \Breadcrumbs::render('tax-category.index'),
            'add_css_heading' => ' add_custom_button_heading',
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Tax Category',
            'link'    => route('tax-category.create'),
            'permission' => 'tax-category-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('tax-category.index'),
            'data_column_config' => config('datatable_column.tax-category'),
        ];
        return view('admin.tax-category.index', $data_array);
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
            'title' => 'Add Tax Category',
            'heading' => 'Add Tax Category',
            'breadcrumb' => \Breadcrumbs::render('tax-category.create'),
        ];
        $data_array['tax_type_arr'] = TaxFormType::dataList()->pluck('name', 'id')->toArray();
        $data_array['parent_category_arr'] = [];
        return view('admin.tax-category.form', $data_array);
    }

    public function store(TaxFormCategoryFormRequest $request)
    {
        try {
            $input_data = $request->input();
            $tax_category = TaxFormCategory::saveData($input_data);
            if ($tax_category) {
                $response_type = 'success';
                $response_message = 'Tax category added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-category.index');
    }

    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxFormCategory       $tax_category [description]
     * @return [type]           [description]
     */
    public function edit(TaxFormCategory $tax_category)
    {
        $data_array = [
            'title' => 'Edit Tax Category',
            'heading' => 'Edit Tax Category',
            'breadcrumb' => \Breadcrumbs::render('tax-category.edit', ['id' => $tax_category->id]),
            'tax_category' => $tax_category
        ];
        $data_array['tax_type_arr'] = TaxFormType::dataList()->pluck('name', 'id')->toArray();
        $data_array['parent_category_arr'] = TaxFormCategory::getParentCategoryList(['type_id' => $tax_category->type_id])->pluck('name', 'id')->toArray();
        return view('admin.tax-category.form', $data_array);
    }

    /**
     * [update description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxFormCategoryFormRequest $request [description]
     * @param  TaxFormCategory             $tax_category    [description]
     * @return [type]                    [description]
     */
    public function update(TaxFormCategoryFormRequest $request, TaxFormCategory $tax_category)
    {
        try {
            $input_data = $request->input();
            $tax_category = TaxFormCategory::saveData($input_data, $tax_category);
            if ($tax_category) {
                $response_type = 'success';
                $response_message = 'Tax category edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-category.index');
    }

    /**
     * [destroy description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxFormCategory       $tax_category [description]
     * @return [type]           [description]
     */
    public function destroy(TaxFormCategory $tax_category)
    {
        try {
            if ($tax_category->childCategory->count() > 0) {
                $response_type = 'error';
                $response_message = 'Unable to delete, Child category exist';
            } elseif ($tax_category->delete()) {
                $response_type = 'success';
                $response_message = 'Tax category deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-category.index');
    }

    public function getParentCategories(Request $request)
    {
        $input = $request->input();
        return TaxFormCategory::getParentCategoryList(['type_id' => $input['type_id']])->pluck('name', 'id')->toArray();
    }
}
