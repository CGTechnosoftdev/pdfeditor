<?php
namespace App\Http\Controllers\Admin;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\BusinessCategoryFormRequest;

class BusinessCategoryController extends AdminBaseController
{
	function __construct()
	{
		$this->middleware('permission:business-category-list|business-category-create|business-category-edit|business-category-delete');
		$this->middleware('permission:business-category-create', ['only' => ['create','store']]);
		$this->middleware('permission:business-category-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:business-category-delete', ['only' => ['destroy']]);    	
	}

	public function index(Request $request)
	{
		$filter_data = $request->input();
		if(request()->ajax()) {
			$action_button_template='admin.datatable.actions';
			$status_button_template = 'admin.datatable.status';
			$model=BusinessCategory::query()->orderBy('created_at','desc');
			$table=Datatables()->of($model);
			if(!empty($filter_data['statusFilter'])){
				$model->where(['status'=>$filter_data['statusFilter']]);
			}
			$table->addIndexColumn();
			$table->addColumn('action','');
			$table->editColumn('action',function($row) use ($action_button_template){
				$buttons=[
					'edit'=>['route_url'=>'business-category.edit', 'route_param'=>[$row->id],'permission'=>'business-category-edit'],
					'delete'=>['route_url'=>'business-category.destroy', 'route_param'=>[$row->id],'permission'=>'business-category-delete'],
				];
				return view($action_button_template,compact('buttons'));
			});

			$table->editColumn('status',function($row) use ($status_button_template){
				$button_data=[
					'id'=>$row->id,
					'type'=>'business_category',
					'status'=>$row->status,
					'action_class' => 'change-status',
					'permission'=>'business-category-edit'
				];
				return view($status_button_template,compact('button_data'));
			});

			return $table->make(true);
		}
		$data_array = [
			'title'=>'Business Category',
			'heading'=>'Manage Business Category',
			'breadcrumb'=>\Breadcrumbs::render('business-category.index'),
		];
		$data_array['add_new_button'] = [
			'label' => 'Add Business-category',
			'link'	=> route('business-category.create'),
			'permission'=>'role-create'
		];
		$data_array['data_table'] = [
			'data_source' => route('business-category.index'),
			'data_column_config' => config('datatable_column.business-category'),
		];
		return view('admin.businesscategory.index',$data_array);
	}

	public function create()
	{  
		$data_array = [
			'title'=>'Add Business Category',
			'heading'=>'Add Business Category',
			'breadcrumb'=>\Breadcrumbs::render('business-category.create'),
		];		
		return view('admin.businesscategory.form',$data_array);

	}


	public function store(BusinessCategoryFormRequest $request) 
	{
		try{
			$input_data=$request->input(); 			
			$business_category = BusinessCategory::saveData($input_data);
			if($business_category){
				$response_type='success';
				$response_message='Business Category added successfully';
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
		return redirect()->route('business-category.index');
	}

	public function edit(BusinessCategory $business_category)
	{
		$data_array = [
			'title'=>'Edit Business Category',
			'heading'=>'Edit Business Category',
			'breadcrumb'=>\Breadcrumbs::render('business-category.edit',['id'=> $business_category->id]),
			'business_category'=> $business_category
		];
		return view('admin.businesscategory.form',$data_array);
	}

	
	public function update(BusinessCategoryFormRequest $request,BusinessCategory $business_category)
	{
		try{			
			$input_data=$request->input(); 
			$business_category = BusinessCategory::saveData($input_data,$business_category);
			if($business_category){
				$response_type='success';
				$response_message='Business Category edited successfully';
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
		return redirect()->route('business-category.index');
	}
	
	public function destroy(BusinessCategory $business_category)
	{
		try{
			if($business_category->delete()){
				$response_type='success';
				$response_message='Business Category deleted successfully';
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
		return redirect()->route('business-category.index');
	}


}
