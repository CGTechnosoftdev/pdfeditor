<?php

namespace App\Http\Controllers\Admin;

use App\Models\TaxForm;
use App\Models\TaxFormCategory;
use Illuminate\Http\Request;
use App\Http\Requests\TaxFormFormRequest;
use App\Http\Requests\TaxFormVersionFormRequest;
use App\Models\TaxFormVersion;
use DB;

class TaxFormController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-11-13
     */
    function __construct()
    {
        $this->middleware('permission:tax-form-list|tax-form-create|tax-form-edit|tax-form-delete');
        $this->middleware('permission:tax-form-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tax-form-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tax-form-delete', ['only' => ['destroy']]);
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }

    public function index(Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = TaxForm::query()->get();
            $table = Datatables()->of($model);
            $table->addIndexColumn();
            $table->editColumn('form_url', function ($row) {
                return "<a href='" . $row->form_url . "' target='_blank'><i class='fa fa-file-pdf-o'></i></a>";
            });
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'tax-form.edit', 'route_param' => [$row->id], 'permission' => 'tax-form-edit'],
                    'delete' => ['route_url' => 'tax-form.destroy', 'route_param' => [$row->id], 'permission' => 'tax-form-delete'],
                    'manage' => ['route_url' => 'tax-form.version.list', 'label' => '', 'route_param' => [$row->id], 'permission' => 'tax-form-version-list'],
                ];
                return view($action_button_template, compact('buttons'));
            });
            $table->editColumn('tax_form', function ($row) {
                return '<a href="#" class="show_tax_form" data-link="' . $row->tax_form . '" title="View"><i class="fa fa-eye"></i></a>';
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'tax-form',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'tax-form-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Tax Forms',
            'heading' => 'Tax Forms',
            'breadcrumb' => \Breadcrumbs::render('tax-form.index'),
            'add_css_heading' => ' add_custom_button_heading',
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Tax Form',
            'link'    => route('tax-form.create'),
            'permission' => 'tax-form-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('tax-form.index'),
            'data_column_config' => config('datatable_column.tax-form'),
        ];
        return view('admin.tax-form.index', $data_array);
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
            'title' => 'Add Tax Form',
            'heading' => 'Add Tax Form',
            'breadcrumb' => \Breadcrumbs::render('tax-form.create'),
            'yes_no_arr' => config('custom_config.yes_no_arr')
        ];
        $data_array['category_arr'] = TaxFormCategory::getCategoryListArr();
        return view('admin.tax-form.form', $data_array);
    }

    public function store(TaxFormFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $input_data = $request->input();
            if (!empty($request->file('form'))) {
                $upload_response = uploadFile($request, 'tax_form');
                if (!empty($upload_response['success'])) {
                    $input_data['form'] = $upload_response['data'];
                }
            }
            $tax_form = TaxForm::saveData($input_data);
            $tax_form_version_data = [
                'tax_form_id' => $tax_form->id,
                'name' => $input_data['version_name'],
                'form' => $input_data['form'],
                'fillable_printable_status' => $input_data['fillable_printable_status'],
                'description' => $input_data['version_description'],
            ];
            $tax_form_version = TaxFormVersion::saveData($tax_form_version_data);
            $tax_form = TaxForm::saveData(['latest_version_id' => $tax_form_version->id], $tax_form);
            if ($tax_form && $tax_form_version) {
                DB::commit();
                $response_type = 'success';
                $response_message = 'Tax form added successfully';
            } else {
                DB::rollback();
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-form.index');
    }

    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxForm       $tax_form [description]
     * @return [type]           [description]
     */
    public function edit(TaxForm $tax_form)
    {
        $data_array = [
            'title' => 'Edit Tax Form',
            'heading' => 'Edit Tax Form',
            'breadcrumb' => \Breadcrumbs::render('tax-form.edit', ['id' => $tax_form->id]),
            'tax_form' => $tax_form
        ];
        $data_array['category_arr'] = TaxFormCategory::getCategoryListArr();
        return view('admin.tax-form.form', $data_array);
    }

    /**
     * [update description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxFormFormRequest $request [description]
     * @param  TaxForm             $tax_form    [description]
     * @return [type]                    [description]
     */
    public function update(TaxFormFormRequest $request, TaxForm $tax_form)
    {
        try {
            $input_data = $request->input();
            $tax_form = TaxForm::saveData($input_data, $tax_form);
            if ($tax_form) {
                $response_type = 'success';
                $response_message = 'Tax form edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-form.index');
    }

    /**
     * [destroy description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxForm       $tax_form [description]
     * @return [type]           [description]
     */
    public function destroy(TaxForm $tax_form)
    {
        try {
            if ($tax_form->delete()) {
                $response_type = 'success';
                $response_message = 'Tax form deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-form.index');
    }

    public function listVersion(Request $request, TaxForm $tax_form)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = TaxFormVersion::query()->where("tax_form_id", "=", $tax_form->id);
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->editColumn('form_url', function ($row) {
                return "<a href='" . $row->form_url . "' target='_blank'><i class='fa fa-file-pdf-o'></i></a>";
            });
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template, $tax_form) {

                $buttons = [
                    'edit' => ['route_url' => 'tax-form.version.edit', 'route_param' => [$tax_form->id, $row->id], 'permission' => 'tax-form-version-edit'],
                ];
                if ($row->id != $tax_form->latest_version_id) {
                    $buttons['delete'] = ['route_url' => 'tax-form.version.destroy', 'route_param' => [$tax_form->id, $row->id], 'permission' => 'tax-form-version-delete'];
                }
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template, $tax_form) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'tax-form-version',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'tax-form-version-edit',
                    'toggle_status' => ($row->id == $tax_form->latest_version_id) ? false : true,
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Tax Form Versions (' . $tax_form->name . ')',
            'heading' => 'Tax Form Versions (' . $tax_form->name . ')',
            'breadcrumb' => \Breadcrumbs::render('tax-form.version.list', $tax_form->id),
            'id' => $tax_form->id,
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Form Version',
            'link'    => route('tax-form.version.create', $tax_form->id),
            'permission' => 'tax-form-version-create'
        ];
        $data_array['back_button'] = [
            'label' => 'Back',
            'link'  => route('tax-form.index'),
        ];
        $data_array['data_table'] = [
            'data_source' => route('tax-form.version.list', $tax_form->id),
            'data_column_config' => config('datatable_column.tax-form-version'),
        ];
        return view('admin.tax-form.version.index', $data_array);
    }

    /**
     * [create description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @return [type]     [description]
     */
    public function createVersion(TaxForm $tax_form)
    {
        $data_array = [
            'title' => 'Add Tax Form Version (' . $tax_form->name . ')',
            'heading' => 'Add Tax Form Version (' . $tax_form->name . ')',
            'breadcrumb' => \Breadcrumbs::render('tax-form.version.create', $tax_form->id),
            'tax_form' => $tax_form,
            'yes_no_arr' => config('custom_config.yes_no_arr')
        ];
        return view('admin.tax-form.version.form', $data_array);
    }

    public function storeVersion(TaxFormVersionFormRequest $request, TaxForm $tax_form)
    {
        DB::beginTransaction();
        try {
            $input_data = $request->input();
            $input_data['tax_form_id'] = $tax_form->id;
            if (!empty($request->file('form'))) {
                $upload_response = uploadFile($request, 'tax_form');
                if (!empty($upload_response['success'])) {
                    $input_data['form'] = $upload_response['data'];
                }
            }
            $tax_form_version = TaxFormVersion::saveData($input_data);
            if (!empty($input_data['is_latest_version'])) {
                $tax_form = TaxForm::saveData(['latest_version_id' => $tax_form_version->id], $tax_form);
            }
            if ($tax_form_version) {
                DB::commit();
                $response_type = 'success';
                $response_message = 'Tax form version added successfully';
            } else {
                DB::rollback();
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-form.version.list', $tax_form->id);
    }


    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @return [type]     [description]
     */
    public function editVersion(TaxForm $tax_form, TaxFormVersion $tax_form_version)
    {
        $tax_form_version->is_latest_version = ($tax_form->latest_version_id == $tax_form_version->id) ? true : false;
        $data_array = [
            'title' => 'Edit Tax Form Version (' . $tax_form->name . ' : ' . $tax_form_version->name . ')',
            'heading' => 'Edit Tax Form Version (' . $tax_form->name . ' : ' . $tax_form_version->name . ')',
            'breadcrumb' => \Breadcrumbs::render('tax-form.version.edit', $tax_form->id, $tax_form_version->id),
            'tax_form' => $tax_form,
            'tax_form_version' => $tax_form_version,
            'yes_no_arr' => config('custom_config.yes_no_arr')
        ];
        return view('admin.tax-form.version.form', $data_array);
    }

    public function updateVersion(TaxFormVersionFormRequest $request, TaxForm $tax_form, TaxFormVersion $tax_form_version)
    {
        DB::beginTransaction();
        try {
            $input_data = $request->input();
            $input_data['tax_form_id'] = $tax_form->id;
            if (!empty($request->file('form'))) {
                $upload_response = uploadFile($request, 'tax_form');
                if (!empty($upload_response['success'])) {
                    $input_data['form'] = $upload_response['data'];
                }
            }
            $tax_form_version = TaxFormVersion::saveData($input_data, $tax_form_version);
            if (!empty($input_data['is_latest_version'])) {
                $tax_form = TaxForm::saveData(['latest_version_id' => $tax_form_version->id], $tax_form);
            }
            if ($tax_form_version) {
                DB::commit();
                $response_type = 'success';
                $response_message = 'Tax form version edited successfully';
            } else {
                DB::rollback();
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-form.version.list', $tax_form->id);
    }

    /**
     * [destroyVersion description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxFormVersion       $tax_form_version [description]
     * @return [type]           [description]
     */
    public function destroyVersion(TaxForm $tax_form, TaxFormVersion $tax_form_version)
    {
        try {
            if ($tax_form_version->delete()) {
                $response_type = 'success';
                $response_message = 'Tax form version deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-form.version.list', $tax_form->id);
    }
}
