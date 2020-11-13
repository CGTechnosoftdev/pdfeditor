<?php

namespace App\Http\Controllers\Admin;

use App\Models\PromoUrl;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\PromoUrlFormRequest;

class PromoUrlController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-11-13
     */
    function __construct()
    {
    	$this->middleware('permission:promo-url-list|promo-url-create|promo-url-edit|promo-url-delete');
    	$this->middleware('permission:promo-url-create', ['only' => ['create','store']]);
    	$this->middleware('permission:promo-url-edit', ['only' => ['edit','update']]);
    	$this->middleware('permission:promo-url-delete', ['only' => ['destroy']]);
    	// app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }
    
    public function index(Request $request)
    {
    	$filter_data = $request->input();
    	if(request()->ajax()) {
    		$action_button_template='admin.datatable.actions';
    		$status_button_template = 'admin.datatable.status';
    		$model=PromoUrl::query();
    		$table=Datatables()->of($model);
    		if(!empty($filter_data['statusFilter'])){
    			$model->where(['status'=>$filter_data['statusFilter']]);
    		}
    		$table->addIndexColumn();
    		$table->addColumn('action','');
    		$table->editColumn('action',function($row) use ($action_button_template){
    			$buttons=[
    				'edit'=>['route_url'=>'promo-url.edit', 'route_param'=>[$row->id],'permission'=>'promo-url-edit'],
    				'delete'=>['route_url'=>'promo-url.destroy', 'route_param'=>[$row->id],'permission'=>'promo-url-delete'],
    			];
    			return view($action_button_template,compact('buttons'));
    		});

    		$table->editColumn('status',function($row) use ($status_button_template){
    			$button_data=[
    				'id'=>$row->id,
    				'type'=>'promo-url',
    				'status'=>$row->status,
    				'action_class' => 'change-status',
    				'permission'=>'promo-url-edit'
    			];
    			return view($status_button_template,compact('button_data'));
    		});

    		return $table->make(true);
    	}

    	$data_array = [
    		'title'=>'Promo URL',
    		'heading'=>'Manage Promo URL',
    		'breadcrumb'=>\Breadcrumbs::render('promo-url.index'),
    	];
    	$data_array['add_new_button'] = [
    		'label' => 'Add Promo URL',
    		'link'	=> route('promo-url.create'),
    		'permission'=>'promo-url-create'
    	];
    	$data_array['data_table'] = [
    		'data_source' => route('promo-url.index'),
    		'data_column_config' => config('datatable_column.promo_url'),
    	];
    	return view('admin.promo-url.index',$data_array);
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
  			'title'=>'Add Promo URL',
  			'heading'=>'Add Promo URL',
  			'breadcrumb'=>\Breadcrumbs::render('promo-url.create'),
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
  		$data_array['promo-url_permissions'] = [];
  		return view('admin.promo-url.form',$data_array);
  	}

  	public function store(PromoUrlFormRequest $request) 
  	{
  		try{
  			$input_data=$request->input(); 
  			$promo_url = PromoUrl::saveData($input_data);
  			$sync_permissions = $promo_url->syncPermissions(($input_data['permission'] ?? []));
  			if($promo_url){
  				$response_type='success';
  				$response_message='Promo Url added successfully';
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
  		return redirect()->route('promo-url.index');
  	}

  	/**
  	 * [edit description]
  	 * @author Akash Sharma
  	 * @date   2020-11-13
  	 * @param  PromoUrl       $promo_url [description]
  	 * @return [type]           [description]
  	 */
  	public function edit(PromoUrl $promo_url)
  	{
  		$data_array = [
  			'title'=>'Edit Promo URL',
  			'heading'=>'Edit Promo URL',
  			'breadcrumb'=>\Breadcrumbs::render('promo-url.edit',['id'=>$promo_url->id]),
  			'promo-url'=>$promo_url
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
  		$data_array['promo-url_permissions'] = \Arr::pluck($promo_url->permissions,'id');
  		return view('admin.promo-url.form',$data_array);
  	}

	/**
	 * [update description]
	 * @author Akash Sharma
	 * @date   2020-11-13
	 * @param  PromoUrlFormRequest $request [description]
	 * @param  PromoUrl             $promo_url    [description]
	 * @return [type]                    [description]
	 */
	public function update(PromoUrlFormRequest $request,PromoUrl $promo_url)
	{
		try{
			$input_data=$request->input(); 
			$input_data=$request->input(); 
			$promo_url = PromoUrl::saveData($input_data,$promo_url);
			$sync_permissions = $promo_url->syncPermissions(($input_data['permission'] ?? []));
			if($promo_url){
				$response_type='success';
				$response_message='Promo Url edited successfully';
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
		return redirect()->route('promo-url.index');
	}
	
	/**
	 * [destroy description]
	 * @author Akash Sharma
	 * @date   2020-11-13
	 * @param  PromoUrl       $promo_url [description]
	 * @return [type]           [description]
	 */
	public function destroy(PromoUrl $promo_url)
	{
		try{
			if($promo_url->is_deletable==config("constant.STATUS_YES") && $promo_url->delete()){
				$response_type='success';
				$response_message='Promo Url deleted successfully';
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
		return redirect()->route('promo-url.index');
	}
}
