<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Models\UserNote;
use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use DB;

class UserController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-10-27
     */
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete');
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }

    public function index(Request $request)
    {
        $filter_data = $request->input();
        if (request()->ajax()) {
            $action_button_template = 'admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model = User::with('modelHasRole')->whereHas('modelHasRole', function ($q) {
                $q->whereIn('role_id', [config('constant.USER_ROLE')]);
            })->where('users.id', '!=', \Auth::user()->id)->get();
            $table = Datatables()->of($model);
            if (!empty($filter_data['statusFilter'])) {
                $model->where(['status' => $filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->addColumn('action', '');
            $table->editColumn('action', function ($row) use ($action_button_template) {
                $buttons = [
                    'view' => ['route_url' => 'user.show', 'route_param' => [$row->id]],
                    'edit' => ['route_url' => 'user.edit', 'route_param' => [$row->id], 'permission' => 'user-edit'],
                    'delete' => ['route_url' => 'user.destroy', 'route_param' => [$row->id], 'permission' => 'user-delete'],
                ];
                return view($action_button_template, compact('buttons'));
            });

            $table->editColumn('status', function ($row) use ($status_button_template) {
                $button_data = [
                    'id' => $row->id,
                    'type' => 'user',
                    'status' => $row->status,
                    'action_class' => 'change-status',
                    'permission' => 'user-edit'
                ];
                return view($status_button_template, compact('button_data'));
            });

            return $table->make(true);
        }
        $data_array = [
            'title' => 'User',
            'heading' => 'Manage User',
            'breadcrumb' => \Breadcrumbs::render('user.index'),
        ];
        $data_array['add_new_button'] = [
            'label' => 'Add User',
            'link'    => route('user.create'),
            'permission' => 'user-create'
        ];
        $data_array['data_table'] = [
            'data_source' => route('user.index'),
            'data_column_config' => config('datatable_column.user'),
        ];
        return view('admin.user.index', $data_array);
    }


    /**
     * [create description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @return [type]     [description]
     */
    public function create()
    {
        $data_array = [
            'title' => 'Add User',
            'heading' => 'Add User',
            'breadcrumb' => \Breadcrumbs::render('user.create'),
        ];
        $data_array['status_arr'] = config('custom_config.all_status_arr');
        return view('admin.user.form', $data_array);
    }

    public function store(UserFormRequest $request)
    {
        DB::beginTransaction();
        try {
            $input_data = $request->input();
            if (!empty($request->file('profile_picture'))) {
                $uploadedImage = uploadFile($request, 'profile_picture');
                if (!empty($uploadedImage['success'])) {
                    $input_data['profile_picture'] = $uploadedImage['data'];
                }
            }
            $user = User::saveData($input_data);
            $user->syncRoles([config('constant.USER_ROLE')]);
            if ($user) {
                DB::commit();
                //Send Welcome Email
                $email_config = [
                    'config_param' => 'welcome_email',
                    'content_data' => [
                        'name' => $user->full_name,
                        'email' => $user->email,
                        'password' => $input_data['password'],
                    ],
                ];
                Mail::to($user->email)->send(new CommonMail($email_config));

                $response_type = 'success';
                $response_message = 'User added successfully';
            } else {
                DB::rollback();
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('user.index');
    }

    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @param  User       $user [description]
     * @return [type]           [description]
     */
    public function edit(User $user)
    {
        $data_array = [
            'title' => 'Edit User',
            'heading' => 'Edit User',
            'breadcrumb' => \Breadcrumbs::render('user.edit', ['id' => $user->id]),
        ];
        $data_array['status_arr'] = config('custom_config.all_status_arr');

        $user['role_id'] = $user->roles->first()->id;
        $data_array['user'] = $user;
        return view('admin.user.form', $data_array);
    }

    /**
     * [update description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @param  UserFormRequest $request [description]
     * @param  User             $user    [description]
     * @return [type]                    [description]
     */
    public function update(UserFormRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $input_data = $request->input();
            if (!empty($request->file('profile_picture'))) {
                $uploadedImage = uploadFile($request, 'profile_picture');
                if (!empty($uploadedImage['success'])) {
                    $input_data['profile_picture'] = $uploadedImage['data'];
                }
            }
            $user = User::saveData($input_data, $user);
            $user->syncRoles([config('constant.USER_ROLE')]);

            if ($user) {
                DB::commit();
                $response_type = 'success';
                $response_message = 'User edited successfully';
            } else {
                DB::rollback();
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again.';
            }
        } catch (Exception $e) {
            DB::rollback();
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('user.index');
    }

    /**
     * [show description]
     * @author Akash Sharma
     * @date   2020-11-02
     * @param  User       $user [description]
     * @return [type]                [description]
     */
    public function show(User $user)
    {
        $data_array = [
            'title' => $user->full_name . " Detail",
            'heading' => $user->full_name . " Detail",
            'breadcrumb' => \Breadcrumbs::render('user.show', $user->id, $user->full_name),
            'user' => $user
        ];
        $data_array['back_button'] = [
            'label' => 'Back',
            'link'  => route('user.index'),
        ];
        return view('admin.user.view', $data_array);
    }

    /**
     * [destroy description]
     * @author Akash Sharma
     * @date   2020-10-27
     * @param  User       $user [description]
     * @return [type]           [description]
     */
    public function destroy(User $user)
    {
        try {
            if ($user->delete()) {
                $response_type = 'success';
                $response_message = 'User deleted successfully';
            } else {
                $response_type = 'error';
                $response_message = 'Error occoured, Please try again';
            }
        } catch (Exception $e) {
            $response_type = 'error';
            $response_message = $e->getMessage();
        }
        set_flash($response_type, $response_message);
        return redirect()->route('user.index');
    }

    public function saveNote(User $user, Request $request)
    {
        $input_data = $request->input();
        $input_data['user_id'] = $user->id;
        $user_note = UserNote::saveData($input_data);
        if ($user_note) {
            $response_type = 'success';
            $response_message = 'User note added successfully';
        } else {
            $response_type = 'error';
            $response_message = 'Error occoured, Please try again.';
        }
        set_flash($response_type, $response_message);
        return redirect()->route('user.show', $user->id);
    }
}
