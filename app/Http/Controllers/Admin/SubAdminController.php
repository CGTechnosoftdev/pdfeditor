<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\SubAdminFormRequest;
use DB;

class SubAdminController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-10-27
     */
    function __construct()
    {
    	$this->middleware('permission:sub-admin-list|sub-admin-create|sub-admin-edit|sub-admin-delete');
    	$this->middleware('permission:sub-admin-create', ['only' => ['create','store']]);
    	$this->middleware('permission:sub-admin-edit', ['only' => ['edit','update']]);
    	$this->middleware('permission:sub-admin-delete', ['only' => ['destroy']]);
    	// app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }
    
    public function index(Request $request)
    {
    	$filter_data = $request->input();
    	if(request()->ajax()) {
    		$action_button_template='admin.datatable.actions';
    		$status_button_template = 'admin.datatable.status';
    		$model=User::query()->orderBy('created_at','desc');
    		$model=User::with('modelHasRole','modelHasRole.role')->where('users.id','!=',\Auth::user()->id)->orderBy('created_at','desc');
    		$table=Datatables()->of($model);
    		if(!empty($filter_data['statusFilter'])){
    			$model->where(['status'=>$filter_data['statusFilter']]);
    		}
    		$table->addIndexColumn();
    		$table->addColumn('action','');
    		$table->editColumn('action',function($row) use ($action_button_template){
    			$buttons=[
    				'edit'=>['route_url'=>'sub-admin.edit', 'route_param'=>[$row->id],'permission'=>'sub-admin-edit'],
    				'delete'=>['route_url'=>'sub-admin.destroy', 'route_param'=>[$row->id],'permission'=>'sub-admin-delete'],
    			];
    			return view($action_button_template,compact('buttons'));
    		});
    		
    		$table->editColumn('status',function($row) use ($status_button_template){
    			$button_data=[
    				'id'=>$row->id,
    				'type'=>'sub-admin',
    				'status'=>$row->status,
    				'action_class' => 'change-status',
    				'permission'=>'sub-admin-edit'
    			];
    			return view($status_button_template,compact('button_data'));
    		});

    		return $table->make(true);
    	}
    	$data_array = [
    		'title'=>'Sub-Admin',
    		'heading'=>'Manage Sub-Admin',
    		'breadcrumb'=>\Breadcrumbs::render('sub-admin.index'),
    	];
    	$data_array['add_new_button'] = [
    		'label' => 'Add Sub-Admin',
    		'link'	=> route('sub-admin.create'),
    		'permission'=>'sub-admin-create'
    	];
    	$data_array['data_table'] = [
    		'data_source' => route('sub-admin.index'),
    		'data_column_config' => config('datatable_column.sub-admin'),
    	];
    	return view('admin.sub-admin.index',$data_array);
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
  			'title'=>'Add Sub-Admin',
  			'heading'=>'Add Sub-Admin',
  			'breadcrumb'=>\Breadcrumbs::render('sub-admin.create'),
  		];
  		$data_array['gender_arr'] = config('custom_config.gender_arr');
        $data_array['status_arr'] = config('custom_config.all_status_arr');
  		$data_array['country_arr'] = Country::getCountryCodeList();
  		$data_array['role_arr'] = Role::list();
  		return view('admin.sub-admin.form',$data_array);
  	}

  	public function store(SubAdminFormRequest $request) 
  	{
  		DB::beginTransaction();
  		try{
  			$input_data=$request->input(); 
  			if(!empty($request->file('profile_picture'))){
  				$uploadedImage = uploadFile($request,'profile_picture');
  				if(!empty($uploadedImage['success'])){
  					$inputData['profile_picture'] = $uploadedImage['data'];
  				}
  			}
  			$sub_admin = User::saveData($input_data);
  			$sub_admin->syncRoles([$input_data['role_id']]);
  			if($sub_admin){
  				DB::commit();
  				$response_type='success';
  				$response_message='Sub-Admin added successfully';
  			}else{
  				DB::rollback();
  				$response_type='error';
  				$response_message='Error occoured, Please try again.';
  			}
  		}
  		catch (Exception $e){
  			DB::rollback();
  			$response_type='error';
  			$response_message=$e->getMessage();
  		}
  		set_flash($response_type,$response_message);
  		return redirect()->route('sub-admin.index');
  	}

  	/**
  	 * [edit description]
  	 * @author Akash Sharma
  	 * @date   2020-10-27
  	 * @param  User       $sub_admin [description]
  	 * @return [type]           [description]
  	 */
  	public function edit(User $sub_admin)
  	{
  		$data_array = [
  			'title'=>'Edit Sub-Admin',
  			'heading'=>'Edit Sub-Admin',
  			'breadcrumb'=>\Breadcrumbs::render('sub-admin.edit',['id'=>$sub_admin->id]),
  		];
  		$data_array['gender_arr'] = config('custom_config.gender_arr');
        $data_array['status_arr'] = config('custom_config.all_status_arr');
  		$data_array['country_arr'] = Country::getCountryCodeList();
  		$data_array['role_arr'] = Role::list();

  		$sub_admin['role_id'] = $sub_admin->roles->first()->id;
        $sub_admin['profile_picture_url'] = getUploadedFile($sub_admin->profile_picture,'profile_picture');
  		$data_array['sub_admin'] = $sub_admin;
  		return view('admin.sub-admin.form',$data_array);
  	}

	/**
	 * [update description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @param  SubAdminFormRequest $request [description]
	 * @param  User             $sub_admin    [description]
	 * @return [type]                    [description]
	 */
	public function update(SubAdminFormRequest $request,User $sub_admin)
	{
		DB::beginTransaction();
  		try{
  			$input_data=$request->input(); 
  			if(!empty($request->file('profile_picture'))){
  				$uploadedImage = uploadFile($request,'profile_picture');
  				if(!empty($uploadedImage['success'])){
  					$input_data['profile_picture'] = $uploadedImage['data'];
  				}
  			}
  			$sub_admin = User::saveData($input_data,$sub_admin);
  			$sub_admin->syncRoles([$input_data['role_id']]);

  			if($sub_admin){
  				DB::commit();
  				$response_type='success';
  				$response_message='Sub-Admin edited successfully';
  			}else{
  				DB::rollback();
  				$response_type='error';
  				$response_message='Error occoured, Please try again.';
  			}
  		}
  		catch (Exception $e){
  			DB::rollback();
  			$response_type='error';
  			$response_message=$e->getMessage();
  		}
  		set_flash($response_type,$response_message);
  		return redirect()->route('sub-admin.index');
	}
	
	/**
	 * [destroy description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @param  User       $sub_admin [description]
	 * @return [type]           [description]
	 */
	public function destroy(User $sub_admin)
	{
		try{
			if($sub_admin->delete()){
				$response_type='success';
				$response_message='Sub-Admin deleted successfully';
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
		return redirect()->route('sub-admin.index');
	}
}
