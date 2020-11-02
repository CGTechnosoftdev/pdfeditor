<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RolesFormRequest;

class RolesController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-10-27
     */
    function __construct()
    {
    	$this->middleware('permission:role-list|role-create|role-edit|role-delete');
    	$this->middleware('permission:role-create', ['only' => ['create','store']]);
    	$this->middleware('permission:role-edit', ['only' => ['edit','update']]);
    	$this->middleware('permission:role-delete', ['only' => ['destroy']]);
    	// app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }
    
    public function index(Request $request)
    {
    	$filter_data = $request->input();
    	if(request()->ajax()) {
    		$action_button_template='admin.datatable.actions';
    		$status_button_template = 'admin.datatable.status';
    		$model=Role::query()->where('is_deletable','!=',config('constant.STATUS_NO'));
    		$table=Datatables()->of($model);
    		if(!empty($filter_data['statusFilter'])){
    			$model->where(['status'=>$filter_data['statusFilter']]);
    		}
    		$table->addIndexColumn();
    		$table->addColumn('action','');
    		$table->editColumn('action',function($row) use ($action_button_template){
    			$buttons=[
    				'edit'=>['route_url'=>'roles.edit', 'route_param'=>[$row->id],'permission'=>'role-edit'],
    				'delete'=>['route_url'=>'roles.destroy', 'route_param'=>[$row->id],'permission'=>'role-delete'],
    			];
    			return view($action_button_template,compact('buttons'));
    		});

    		$table->editColumn('status',function($row) use ($status_button_template){
    			$button_data=[
    				'id'=>$row->id,
    				'type'=>'role',
    				'status'=>$row->status,
    				'action_class' => 'change-status',
    				'permission'=>'role-edit'
    			];
    			return view($status_button_template,compact('button_data'));
    		});

    		return $table->make(true);
    	}

    	$data_array = [
    		'title'=>'Roles and Rights',
    		'heading'=>'Manage Roles and Rights',
    		'breadcrumb'=>\Breadcrumbs::render('roles.index'),
    	];
    	$data_array['add_new_button'] = [
    		'label' => 'Add Role and Rights',
    		'link'	=> route('roles.create'),
    		'permission'=>'role-create'
    	];
    	$data_array['data_table'] = [
    		'data_source' => route('roles.index'),
    		'data_column_config' => config('datatable_column.roles'),
    	];
    	return view('admin.role.index',$data_array);
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
  			'title'=>'Add Role and Rights',
  			'heading'=>'Add Role and Rights',
  			'breadcrumb'=>\Breadcrumbs::render('roles.create'),
  		];
  		$permissions = Permission::get();
  		$grouped_permissions = [];
  		foreach($permissions as $permission){
  			$grouped_permissions[$permission->module][]=[
  				'id'=>$permission->id,
  				'name'=>ucwords(str_replace("-", " ", $permission->name)),
  			];
  		}
  		$data_array['permissions'] = $grouped_permissions;
  		$data_array['role_permissions'] = [];
  		return view('admin.role.form',$data_array);
  	}

  	public function store(RolesFormRequest $request) 
  	{
  		try{
  			$input_data=$request->input(); 
  			$role = Role::saveData($input_data);
  			$sync_permissions = $role->syncPermissions($input_data['permission']);
  			if($role){
  				$response_type='success';
  				$response_message='Role added successfully';
  			}else{
  				$response_type='error';
  				$response_message='Error occoured, Please try again.';
  			}
  		}
  		catch (Exception $e){
  			$response_type='error';
  			$response_message=$e->getMessage();
  		}
  		set_flash($response_type,$response_message);
  		return redirect()->route('roles.index');
  	}

  	/**
  	 * [edit description]
  	 * @author Akash Sharma
  	 * @date   2020-10-27
  	 * @param  Role       $role [description]
  	 * @return [type]           [description]
  	 */
  	public function edit(Role $role)
  	{
  		$data_array = [
  			'title'=>'Edit Role and Rights',
  			'heading'=>'Edit Role and Rights',
  			'breadcrumb'=>\Breadcrumbs::render('roles.edit',['id'=>$role->id]),
  			'role'=>$role
  		];
  		$permissions = Permission::get();
  		$grouped_permissions = [];
  		foreach($permissions as $permission){
  			$grouped_permissions[$permission->module][]=[
  				'id'=>$permission->id,
  				'name'=>ucwords(str_replace("-", " ", $permission->name)),
  			];
  		}
  		$data_array['permissions'] = $grouped_permissions;
  		$data_array['role_permissions'] = \Arr::pluck($role->permissions,'id');
  		return view('admin.role.form',$data_array);
  	}

	/**
	 * [update description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @param  RolesFormRequest $request [description]
	 * @param  Role             $role    [description]
	 * @return [type]                    [description]
	 */
	public function update(RolesFormRequest $request,Role $role)
	{
		try{
			$input_data=$request->input(); 
			$input_data=$request->input(); 
			$role = Role::saveData($input_data,$role);
			$sync_permissions = $role->syncPermissions($input_data['permission']);
			if($role){
				$response_type='success';
				$response_message='Role edited successfully';
			}else{
				$response_type='error';
				$response_message='Error occoured, Please try again.';
			}
		}
		catch (Exception $e){
			$response_type='error';
			$response_message=$e->getMessage();
		}
		set_flash($response_type,$response_message);
		return redirect()->route('roles.index');
	}
	
	/**
	 * [destroy description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @param  Role       $role [description]
	 * @return [type]           [description]
	 */
	public function destroy(Role $role)
	{
		try{
			if($role->is_deletable==config("constant.STATUS_YES") && $role->delete()){
				$response_type='success';
				$response_message='Role deleted successfully';
			}else{
				$response_type='error';
				$response_message='Error occoured, Please try again';
			}
		}
		catch (Exception $e){
			$response_type='error';
			$response_message=$e->getMessage();
		}
		set_flash($response_type,$response_message);
		return redirect()->route('roles.index');
	}
}
