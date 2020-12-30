<?php

namespace App\Http\Controllers\Admin;

use App\Models\TaxCalendar;
use App\Models\TaxForm;
use Illuminate\Http\Request;
use App\Http\Requests\TaxCalendarFormRequest;
use DB;

class TaxCalendarController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-11-13
     */
    function __construct()
    {
        $this->middleware('permission:tax-calendar-list|tax-calendar-create|tax-calendar-edit|tax-calendar-delete');
        $this->middleware('permission:tax-calendar-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tax-calendar-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tax-calendar-delete', ['only' => ['destroy']]);
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }

    public function index(Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = TaxCalendar::query()->get();
            $table = Datatables()->of($model);
            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->editColumn('description', function ($row) {
                return (strlen($row->description) > 50) ? substr($row->description, 0, 50) . "..." : $row->description;
            });
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'edit' => ['route_url' => 'tax-calendar.edit', 'route_param' => [$row->id], 'permission' => 'tax-calendar-edit'],
                    'delete' => ['route_url' => 'tax-calendar.destroy', 'route_param' => [$row->id], 'permission' => 'tax-calendar-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'tax-calendar',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'tax-calendar-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title' => 'Tax Calendar',
            'heading' => 'Tax Calendar',
            'breadcrumb' => \Breadcrumbs::render('tax-calendar.index'),
            'add_css_heading' => ' add_custom_button_heading',
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add Tax Calendar',
            'link'    => route('tax-calendar.create'),
            'permission' => 'tax-calendar-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('tax-calendar.index'),
            'data_column_config' => config('datatable_column.tax-calendar'),
        ];
        return view('admin.tax-calendar.index', $data_array);
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
            'title' => 'Add Tax Calendar',
            'heading' => 'Add Tax Calendar',
            'breadcrumb' => \Breadcrumbs::render('tax-calendar.create'),
        ];
        $data_array['tax_for_arr'] = config('custom_config.tax_for_arr');
        $data_array['tax_forms_arr'] = TaxForm::dataList()->pluck('name', 'id')->toArray();
        return view('admin.tax-calendar.form', $data_array);
    }

    public function store(TaxCalendarFormRequest $request)
    {
        try {
            $input_data = $request->input();
            $tax_calendar = TaxCalendar::saveData($input_data);
            if ($tax_calendar) {
                $response_type = 'success';
                $response_message = 'Tax calendar added successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-calendar.index');
    }

    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxCalendar       $tax_calendar [description]
     * @return [type]           [description]
     */
    public function edit(TaxCalendar $tax_calendar)
    {
        $data_array = [
            'title' => 'Edit Tax Calendar',
            'heading' => 'Edit Tax Calendar',
            'breadcrumb' => \Breadcrumbs::render('tax-calendar.edit', ['id' => $tax_calendar->id]),
            'tax_calendar' => $tax_calendar
        ];
        $data_array['tax_for_arr'] = config('custom_config.tax_for_arr');
        $data_array['tax_forms_arr'] = TaxForm::dataList()->pluck('name', 'id')->toArray();
        return view('admin.tax-calendar.form', $data_array);
    }

    /**
     * [update description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxCalendarFormRequest $request [description]
     * @param  TaxCalendar             $tax_calendar    [description]
     * @return [type]                    [description]
     */
    public function update(TaxCalendarFormRequest $request, TaxCalendar $tax_calendar)
    {
        try {
            $input_data = $request->input();
            $tax_calendar = TaxCalendar::saveData($input_data, $tax_calendar);
            if ($tax_calendar) {
                $response_type = 'success';
                $response_message = 'Tax calendar edited successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-calendar.index');
    }

    /**
     * [destroy description]
     * @author Akash Sharma
     * @date   2020-11-13
     * @param  TaxCalendar       $tax_calendar [description]
     * @return [type]           [description]
     */
    public function destroy(TaxCalendar $tax_calendar)
    {
        try {
            if ($tax_calendar->delete()) {
                $response_type = 'success';
                $response_message = 'Tax calendar deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (\Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('tax-calendar.index');
    }
}
