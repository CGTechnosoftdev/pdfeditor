<?php
namespace App\Http\Controllers\Admin;
use App\Models\Top100Form;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Top100formFormRequest;
use App\Http\Requests\Top100formVersionFormRequest;
use App\Models\Form;
use App\Http\Requests\Top100formFaqFormRequest;
use App\Models\Faq;




class Top100FormController extends AdminBaseController
{
	function __construct()
	{
		$this->middleware('permission:top-100-form-list|top-100-form-create|top-100-form-edit|top-100-form-delete');
		$this->middleware('permission:top-100-form-create', ['only' => ['create','store']]);
		$this->middleware('permission:top-100-form-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:top-100-form-delete', ['only' => ['destroy']]);    


		$this->middleware('permission:top-100-form-version-list|top-100-form-version-create|top-100-form-version-edit|top-100-form-version-delete');
		$this->middleware('permission:top-100-form-version-create', ['only' => ['createForm','storeForm']]);
		$this->middleware('permission:top-100-form-version-edit', ['only' => ['editForm','updateForm']]);
		$this->middleware('permission:top-100-form-version-delete', ['only' => ['destroyForm']]);    


		$this->middleware('permission:top-100-form-faq-list|top-100-form-faq-create|top-100-form-faq-edit|top-100-form-faq-delete');
		$this->middleware('permission:top-100-form-faq-create', ['only' => ['createFaq','storeFaq']]);
		$this->middleware('permission:top-100-form-faq-edit', ['only' => ['editFaq','updateFaq']]);
		$this->middleware('permission:top-100-form-faq-delete', ['only' => ['destroyFaq']]);    

	}

	public function index(Request $request)
	{
		$filter_data = $request->input();
		if(request()->ajax()) {
			$action_button_template='admin.datatable.actions';
			$status_button_template = 'admin.datatable.status';
			$model=Top100Form::query();
			$table=Datatables()->of($model);
			if(!empty($filter_data['statusFilter'])){
				$model->where(['status'=>$filter_data['statusFilter']]);
			}
			$table->addIndexColumn();
			$table->addColumn('action','');
			$table->editColumn('action',function($row) use ($action_button_template){
				$buttons=[
					'view'=>['route_url'=>'top-100-form.show', 'route_param'=>[$row->id]],
					'edit'=>['route_url'=>'top-100-form.edit', 'route_param'=>[$row->id],'permission'=>'top-100-form-edit'],
					'delete'=>['route_url'=>'top-100-form.destroy', 'route_param'=>[$row->id],'permission'=>'top-100-form-delete'],
					'manage' =>['route_url'=>'top100form.form.list','label' => '', 'route_param'=>[$row->id],'permission'=>'top-100-form-version-list'],
					'manage2' =>['route_url'=>'top100form.faq.list','label' => '', 'route_param'=>[$row->id],'permission'=>'top-100-form-faq-list'],
				];
				return view($action_button_template,compact('buttons'));
			});

			$table->editColumn('status',function($row) use ($status_button_template){
				$button_data=[
					'id'=>$row->id,
					'type'=>'top-100-form',
					'status'=>$row->status,
					'action_class' => 'change-status',
					'permission'=>'top-100-form-edit'
				];
				return view($status_button_template,compact('button_data'));
			});

			return $table->make(true);
		}
		$data_array = [
			'title'=>'Top 100 Form',
			'heading'=>'Manage Top 100 Form',
			'breadcrumb'=>\Breadcrumbs::render('top-100-form.index'),
		];
		$data_array['add_new_button'] = [
			'label' => 'Add Top 100 Form',
			'link'	=> route('top-100-form.create'),
			'permission'=>'top-100-form-create'
		];
		$data_array['data_table'] = [
			'data_source' => route('top-100-form.index'),
			'data_column_config' => config('datatable_column.top100_forms'),
		];   	
		return view('admin.top100form.index',$data_array);
	} 

	public function create()
	{
		$data_array = [
			'title'=>'Add Top 100 Form',
			'heading'=>'Add Top 100 Form',

		];        
		return view('admin.top100form.form',$data_array);       
	}


	public function store(Top100formFormRequest $request) 
	{
		try{

			$input_data=$request->input();

			$businessCategory = Top100Form::saveData($input_data);

			if($businessCategory){
				$response_type='success';
				$response_message='Top100Form added successfully';
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
		return redirect()->route('top-100-form.index');
	} 

    /**
  	 * [edit description]
  	 * @author Akash Sharma
  	 * @date   2020-10-27
  	 * @param  Role       $role [description]
  	 * @return [type]           [description]
  	 */
    public function edit(Top100Form $top_100_form)
    {

    	$data_array = [
    		'title'=>'Edit Top100Form Category',
    		'heading'=>'Edit Top100Form Category',
    		'breadcrumb'=>\Breadcrumbs::render('top-100-form.edit',['id'=> $top_100_form->id]),
    		'top100Form'=> $top_100_form
    	];


       // $data_array["business_category"]=$businessCategory;
    	return view('admin.top100form.form',$data_array);
    } 

	/**
	 * [update description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @param  RolesFormRequest $request [description]
	 * @param  Role             $role    [description]
	 * @return [type]                    [description]
	 */
	public function update(Top100formFormRequest $request,Top100Form $top_100_form)
	{
		try{				
			$input_data=$request->input(); 

			$top_100_form = Top100Form::saveData($input_data,$top_100_form);

			if($top_100_form){
				$response_type='success';
				$response_message='Top100Form edited successfully';
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
		return redirect()->route('top-100-form.index');
	}

	/**
	 * [destroy description]
	 * @author Akash Sharma
	 * @date   2020-10-27
	 * @param  Role       $role [description]
	 * @return [type]           [description]
	 */
	public function destroy(Top100Form $top_100_form)
	{
		try{

			$top_100_form->delete();
			$response_type='success';
			$response_message='Top100Form deleted successfully';
		}
		catch (Exception $e){
			$response_type='error';
			$response_message=$e->getMessage();
		}
		set_flash($response_type,$response_message);
		return redirect()->route('top-100-form.index');
	}

	public function show(Top100Form $top_100_form){
		$data_array = [
			'title'=>$top_100_form->name." Detail",
			'heading'=>$top_100_form->name." Detail",
			'breadcrumb'=>\Breadcrumbs::render('top-100-form.show',$top_100_form->id,$top_100_form->name),
			'top_100_form' => $top_100_form
		];
		$data_array['back_button'] = [
			'label' => 'Back',
			'link'  => route('top-100-form.index'),
		];
		return view('admin.top100form.view',$data_array);
	}

	public function listForm(Request $request,Top100Form $top_100_form){
		$filter_data = $request->input();		   
		if(request()->ajax()) {
			$action_button_template='admin.datatable.actions';
			$status_button_template = 'admin.datatable.status';
			$model=Form::query()->where("type_id","=",$top_100_form->id);
			$table=Datatables()->of($model);
			if(!empty($filter_data['statusFilter'])){
				$model->where(['status'=>$filter_data['statusFilter']]);
			}
			$table->addIndexColumn();
			$table->addColumn('action','');
			$table->editColumn('action',function($row) use ($action_button_template,$top_100_form){

				$buttons=[
					'edit'=>['route_url'=>'top100form.form.edit', 'route_param'=>[$top_100_form->id,$row->id],'permission'=>'top-100-form-version-edit'],
					'delete'=>['route_url'=>'top100form.form.destroy', 'route_param'=>[$top_100_form->id,$row->id],'permission'=>'top-100-form-version-delete'],
				];
				return view($action_button_template,compact('buttons'));
			});

			$table->editColumn('status',function($row) use ($status_button_template){
				$button_data=[
					'id'=>$row->id,
					'type'=>'form',
					'status'=>$row->status,
					'action_class' => 'change-status',
					'permission'=>'top-100-form-version-edit'
				];
				return view($status_button_template,compact('button_data'));
			});

			return $table->make(true);
		}
		
		$data_array = [
			'title'=>'Manage Form Version ',
			'heading'=>'Manage Form Version ('.$top_100_form->name.')',
			'breadcrumb'=>\Breadcrumbs::render('top100form.form.list',$top_100_form->id),
			'id' => $top_100_form->id,
		];
		$data_array['add_new_button'] = [
			'label' => 'Add Form Version',
			'link'	=> route('top100form.form.create',$top_100_form->id),
			'permission'=>'top-100-form-version-create'
		];
		$data_array['back_button'] = [
			'label' => 'Back',
			'link'  => route('top-100-form.index'),
		];
		$data_array['data_table'] = [
			'data_source' => route('top100form.form.list',$top_100_form->id),
			'data_column_config' => config('datatable_column.forms'),
		];
		return view('admin.top100form.form.index',$data_array);

	}

	public function createForm(Request $request,Top100Form $top_100_form){	
		$data_array = [
			'title'=>'Add Form Version',
			'heading'=>'Add Form Version',
			'breadcrumb'=>\Breadcrumbs::render('top100form.form.create',$top_100_form->id),
			'top_100_form' => $top_100_form,			
			'yes_no_arr' =>config("custom_config.yes_no_arr"),
		];      

		return view('admin.top100form.form.form',$data_array); 

	}

	public function storeForm(Top100formVersionFormRequest $request,Top100Form $top_100_form) {
		try{
			$input_data=$request->input(); 
			$input_data["type_id"]=$top_100_form->id;
			$input_data["form_type"]=config("constant.TOP_100_FORM");

			if(!empty($request->file('form_file'))){
				$upload_response = uploadFile($request,'form_file');
				if(!empty($upload_response['success'])){
					$input_data['form_file'] = $upload_response['data'];
				}
			}

			$form = Form::saveData($input_data);
			if(!empty($input_data["is_latest_version"])){
				$top_100_form = Top100Form::saveData(['lastest_version_id'=>$form->id],$top_100_form);
			}
			if($form){
				$response_type='success';
				$response_message='Form added successfully';
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
		return redirect()->route('top100form.form.list',$top_100_form->id);

	}

	public function editForm(Top100Form $top_100_form,Form $form,Request $request){	
		if(!empty($form->form_file)){
			$form->form_file_url = getUploadedFile($form->form_file,'form_file');
		}
		$form->is_latest_version = ($top_100_form->lastest_version_id == $form->id);

		$data_array = [
			'title'=>'Edit Form Version',
			'heading'=>'Edit Form Version',
			'breadcrumb'=>\Breadcrumbs::render('top100form.form.edit',$top_100_form->id,$form->id),
			'form'=> $form,
			'top_100_form' => $top_100_form,	
			'yes_no_arr' => config("custom_config.yes_no_arr")
		];
		return view('admin.top100form.form.form',$data_array);

	}

	public function updateForm(Top100formVersionFormRequest $request,Top100Form $top_100_form,Form $form){

		try{
			$input_data=$request->input(); 
			if(!empty($request->file('form_file'))){
				$upload_response = uploadFile($request,'form_file');
				if(!empty($upload_response['success'])){
					$input_data['form_file'] = $upload_response['data'];
				}
			}

			$form = Form::saveData($input_data,$form);
			if(!empty($input_data["is_latest_version"])){
				$top_100_form = Top100Form::saveData(['lastest_version_id'=>$form->id],$top_100_form);
			}

			if($form){
				$response_type='success';
				$response_message='Form edited successfully';
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
		//return redirect()->route('form.index');
		return redirect()->route('top100form.form.list',$top_100_form->id);


	}

	public function destroyForm(Request $request,Top100Form $top_100_form,Form $form){
		try{
			$form->delete();
			$response_type='success';
			$response_message='Form deleted successfully';
		}
		catch (Exception $e){
			$response_type='error';
			$response_message=$e->getMessage();
		}
		set_flash($response_type,$response_message);
		return redirect()->route('top100form.form.list',$top_100_form->id);

	}


	public function listFaq(Top100Form $top_100_form,Request $request){

		$filter_data = $request->input();

		if(request()->ajax()) {
			$action_button_template='admin.datatable.actions';
			$status_button_template = 'admin.datatable.status';
			$model=Faq::query()->where("type_id","=",$top_100_form->id);
			$table=Datatables()->of($model);

			if(!empty($filter_data['statusFilter'])){
				$model->where(['status'=>$filter_data['statusFilter']]);
			}
			$table->addIndexColumn();
			$table->addColumn('action','');
			$table->editColumn('action',function($row) use ($action_button_template,$top_100_form){				
				$buttons=[
					'edit'=>['route_url'=>'top100form.faq.edit', 'route_param'=>[$top_100_form->id,$row->id],'permission'=>'top-100-form-faq-edit'],
					'delete'=>['route_url'=>'top100form.faq.destroy', 'route_param'=>[$top_100_form->id,$row->id],'permission'=>'top-100-form-faq-delete'],
				];
				return view($action_button_template,compact('buttons'));
			});

			$table->editColumn('status',function($row) use ($status_button_template){
				$button_data=[
					'id'=>$row->id,
					'type'=>'faq',
					'status'=>$row->status,
					'action_class' => 'change-status',
					'permission'=>'top-100-form-faq-edit'
				];
				return view($status_button_template,compact('button_data'));
			});

			return $table->make(true);
		}
		$data_array = [
			'title'=>'Manage Faq ',
			'heading'=>'Manage Faq ('.$top_100_form->name.')',
			'breadcrumb'=>\Breadcrumbs::render('top100form.faq.list',$top_100_form->id),
		];
		$data_array['add_new_button'] = [
			'label' => 'Add Faq ',
			'link'	=> route('top100form.faq.create',$top_100_form->id),
			'permission'=>'top-100-form-version-create'
		];
		$data_array['back_button'] = [
			'label' => 'Back',
			'link'  => route('top-100-form.index'),
		];
		$data_array['data_table'] = [
			'data_source' => route('top100form.faq.list',$top_100_form->id),
			'data_column_config' => config('datatable_column.faq'),
		];
		return view('admin.top100form.faq.index',$data_array);

	} 

	public function createFaq(Top100Form $top_100_form,Request $request){

		if(!empty($request->frm_id))
			$top_id=$request->frm_id;
		$data_array = [
			'title'=>'Add Faq',
			'heading'=>'Add Faq',
			'top_100_form' => $top_100_form,
			'breadcrumb'=>\Breadcrumbs::render('top100form.faq.create',$top_100_form->id),
		];      

		return view('admin.top100form.faq.form',$data_array); 

	}

	public function storeFaq(Top100Form $top_100_form,Top100formFaqFormRequest $request) {
		try{
			$input_data=$request->input();
			$input_data['faq_type'] = config("constant.TOP_100_FORM");
			$input_data['type_id'] = $top_100_form->id;
			$faq = Faq::saveData($input_data);
			if($faq){
				$response_type='success';
				$response_message='Faq added successfully';
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
		return redirect()->route('top100form.faq.list',$top_100_form->id);

	}

	public function editFaq(Top100Form $top_100_form,Faq $faq,Request $request){
		$data_array = [
			'title'=>'Edit Faq',
			'heading'=>'Edit Faq',
			'breadcrumb'=>\Breadcrumbs::render('top100form.faq.edit',$top_100_form->id,$faq->id),
			'faq'=> $faq,
			'top_100_form' => $top_100_form,
		];
		return view('admin.top100form.faq.form',$data_array);

	}

	public function updateFaq(Top100formFaqFormRequest $request,Top100Form $top_100_form,Faq $faq){
		try{				
			$input_data=$request->input(); 
			$faq= Form::saveData($input_data,$faq);
			if($faq){
				$response_type='success';
				$response_message='Faq edited successfully';
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
		return redirect()->route('top100form.faq.list',$top_100_form->id);
	}

	public function destroyFaq(Request $request,Top100Form $top_100_form,Faq $faq){
		try{
			$faq->delete();
			$response_type='success';
			$response_message='Faq deleted successfully';
		}
		catch (Exception $e){
			$response_type='error';
			$response_message=$e->getMessage();
		}
		set_flash($response_type,$response_message);
		return redirect()->route('top100form.faq.list',$top_100_form->id);

	}


}
