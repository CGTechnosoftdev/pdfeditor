<?php

namespace App\Http\Controllers\Admin;

use App\Models\CatalogFormCategory;
use Illuminate\Http\Request;
use App\Http\Requests\CatalogFormCategoryFormRequest;

class CatalogFormCategoryController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-11-13
     */
    function __construct()
    {
        $this->middleware('permission:catalog-category-list|catalog-category-create|catalog-category-edit|catalog-category-delete');
        $this->middleware('permission:catalog-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:catalog-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:catalog-category-delete', ['only' => ['destroy']]);
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }

    public function index(Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = CatalogFormCategory::query()->get();
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'catalog-category.edit', 'route_param' => [$row->id], 'permission' => 'catalog-category-edit'],
                    'delete' => ['route_url' => 'catalog-category.destroy', 'route_param' => [$row->id], 'permission' => 'catalog-category-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'catalog-category',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'catalog-category-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Catalog Category',
            'heading' => 'Catalog Category',
            'breadcrumb' => \Breadcrumbs::render('catalog-category.index'),
            'add_css_heading' => ' add_custom_button_heading',
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Catalog Category',
            'link'    => route('catalog-category.create'),
            'permission' => 'catalog-category-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('catalog-category.index'),
            'data_column_config' => config('datatable_column.catalog-category'),
        ];
        return view('admin.catalog-category.index', $data_array);
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
            'title' => 'Add Catalog Category',
            'heading' => 'Add Catalog Category',
            'breadcrumb' => \Breadcrumbs::render('catalog-category.create'),
        ];
        $data_array['catalog_type_arr'] = config('custom_config.catalog_types');
        $data_array['parent_category_arr'] = [];
        return view('admin.catalog-category.form', $data_array);
    }

    public function store(CatalogFormCategoryFormRequest $request)
    {
        try {
            $input_data = $request->input();
            $catalog_category = CatalogFormCategory::saveData($input_data);
            if ($catalog_category) {
                $response_type = 'success';
                $response_message = 'Catalog category added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('catalog-category.index');
    }

    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  CatalogFormCategory       $catalog_category [description]
     * @return [type]           [description]
     */
    public function edit(CatalogFormCategory $catalog_category)
    {
        $data_array = [
            'title' => 'Edit Catalog Category',
            'heading' => 'Edit Catalog Category',
            'breadcrumb' => \Breadcrumbs::render('catalog-category.edit', ['id' => $catalog_category->id]),
            'catalog_category' => $catalog_category
        ];
        $data_array['catalog_type_arr'] = config('custom_config.catalog_types');
        $data_array['parent_category_arr'] = CatalogFormCategory::getParentCategoryList(['type' => $catalog_category->type])->pluck('name', 'id')->toArray();
        return view('admin.catalog-category.form', $data_array);
    }

    /**
     * [update description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  CatalogFormCategoryFormRequest $request [description]
     * @param  CatalogFormCategory             $catalog_category    [description]
     * @return [type]                    [description]
     */
    public function update(CatalogFormCategoryFormRequest $request, CatalogFormCategory $catalog_category)
    {
        try {
            $input_data = $request->input();
            $catalog_category = CatalogFormCategory::saveData($input_data, $catalog_category);
            if ($catalog_category) {
                $response_type = 'success';
                $response_message = 'Catalog category edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('catalog-category.index');
    }

    /**
     * [destroy description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  CatalogFormCategory       $catalog_category [description]
     * @return [type]           [description]
     */
    public function destroy(CatalogFormCategory $catalog_category)
    {
        try {
            if ($catalog_category->childCategory->count() > 0) {
                $response_type = 'error';
                $response_message = 'Unable to delete, Child category exist';
            } elseif ($catalog_category->delete()) {
                $response_type = 'success';
                $response_message = 'Catalog category deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('catalog-category.index');
    }

    public function getParentCategories(Request $request)
    {
        $input = $request->input();
        return CatalogFormCategory::getParentCategoryList(['type' => $input['type']])->pluck('name', 'id')->toArray();
    }
}
