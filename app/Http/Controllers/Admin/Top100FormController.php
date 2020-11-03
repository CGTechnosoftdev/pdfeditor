<?php
namespace App\Http\Controllers\Admin;
use App\Models\Top100Form;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Top100formFormRequest;
use App\Http\Requests\FormFormRequest;
use App\Models\Form;
use App\Http\Requests\FaqFormRequest;
use App\Models\Faq;




class Top100FormController extends AdminBaseController
{
	function __construct()
	{
		$this->middleware('permission:top-100-form-list|top-100-form-create|top-100-form-edit|top-100-form-delete');
		$this->middleware('permission:top-100-form-create', ['only' => ['create','store']]);
		$this->middleware('permission:top-100-form-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:top-100-form-delete', ['only' => ['destroy']]);    	
	}

	public function index(Request $request)
	{
		$filter_data = $request->input();
		if(request()->ajax()) {
			$action_button_template='admin.datatable.actions';
			$status_button_template = 'admin.datatable.status';
			$model=Top100Form::query()->orderBy('created_at','desc');
			$table=Datatables()->of($model);
			if(!empty($filter_data['statusFilter'])){
				$model->where(['status'=>$filter_data['statusFilter']]);
			}
			$table->addIndexColumn();
			$table->addColumn('action','');
			$table->editColumn('action',function($row) use ($action_button_template){
				$buttons=[
					'edit'=>['route_url'=>'top-100-form.edit', 'route_param'=>[$row->id],'permission'=>'top-100-form-edit'],
					'delete'=>['route_url'=>'top-100-form.destroy', 'route_param'=>[$row->id],'permission'=>'top-100-form-delete'],
					'manage' =>['route_url'=>'top100form.form.list','label' => '', 'route_param'=>['frm_id'=>$row->id],'permission'=>'top100form.form.list'],
					'manage2' =>['route_url'=>'top100form.faq.list','label' => '', 'route_param'=>[$row->id],'permission'=>'top100form.faq.list'],
				];
				return view($action_button_template,compact('buttons'));
			});

			$table->editColumn('status',function($row) use ($status_button_template){
				$button_data=[
					'id'=>$row->id,
					'type'=>'top-100-form',
					'status'=>$row->status,
					'action_class' => 'change-status',
					'permission'=>'top-100-form-edits'
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
			'permission'=>'role-create'
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

	public function listForm(Request $request){
		$top_id="";

		if(!empty($request->frm_id))
			$top_id=$request->frm_id;		
		$filter_data = $request->input();		   
		if(request()->ajax()) {
			$top_id="";
			if(!empty($request->frm_id))
				$top_id=$request->frm_id;
			$action_button_template='admin.datatable.actions';
			$status_button_template = 'admin.datatable.status';
			$model=Form::query()->where("type_id","=",$top_id)->orderBy('created_at','desc');
			$table=Datatables()->of($model);
			if(!empty($filter_data['statusFilter'])){
				$model->where(['status'=>$filter_data['statusFilter']]);
			}
			$table->addIndexColumn();
			$table->addColumn('action','');
			$table->editColumn('action',function($row) use ($action_button_template){
				if(!empty($_GET["frm_id"]))
					$top_id=$_GET["frm_id"];
				$buttons=[
					'edit'=>['route_url'=>'top100form.form.edit', 'route_param'=>[$row->id,"frm_id=".$top_id],'permission'=>'form-edit'],
					'delete'=>['route_url'=>'top100form.form.destroy', 'route_param'=>[$row->id,"frm_id=".$top_id],'permission'=>'form-delete'],
				];
				return view($action_button_template,compact('buttons'));
			});

			$table->editColumn('status',function($row) use ($status_button_template){
				$button_data=[
					'id'=>$row->id,
					'type'=>'form',
					'status'=>$row->status,
					'action_class' => 'change-status',
					'permission'=>'form-edit'
				];
				return view($status_button_template,compact('button_data'));
			});

			return $table->make(true);
		}
		$top_100_form=Top100Form::find($top_id);
		$data_array = [
			'title'=>'Manage Form Version ',
			'heading'=>'Manage Form Version ('.$top_100_form->name.')',
			'breadcrumb'=>\Breadcrumbs::render('top100form.form.list'),
			'top_id' => $top_id,
		];
		$data_array['add_new_button'] = [
			'label' => 'Add Manage Form',
			'link'	=> route('top100form.form.create',"frm_id=$top_id"),
			'permission'=>'role-create'
		];
		$data_array['data_table'] = [
			'data_source' => route('top100form.form.list'),
			'data_column_config' => config('datatable_column.forms'),
		];
		return view('admin.top100form.form.index',$data_array);

	}

	public function createForm(Request $request){			
		$top_id="";
		$top_100_form=config("constant.TOP_100_FORM");
		$yes_no_arr=config("custom_config.yes_no_arr");


		if(!empty($request->frm_id))
			$top_id=$request->frm_id;
		$data_array = [
			'title'=>'Add Form Version',
			'heading'=>'Add Form Version',
			'breadcrumb'=>\Breadcrumbs::render('top100form.form.create'),
			'frm_id' => $top_id,
			'top_100_form' => $top_100_form,
			'yes_no_arr' => $yes_no_arr,
		];      

		return view('admin.top100form.form.form',$data_array); 

	}

	public function storeForm(FormFormRequest $request) {

		try{
			$input_data=$request->validate([
				'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2',
				'form_file' => 'required'

			]);
			$input_data=$request->input(); 

			if(!empty($request->file('form_file'))){
				$upload_response = uploadFile($request,'form_file');
				if(!empty($upload_response['success'])){
					$input_data['form_file'] = $upload_response['data'];
				}
			}

			$businessCategory = Form::saveData($input_data);

			if($input_data["lastest_version_id"])
			{
				$top_100_form=Top100Form::find($input_data["type_id"]);
				Top100Form::where('id',$input_data["type_id"])->update(['lastest_version_id' => $businessCategory->id]);
			}

			if($businessCategory){
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
		return redirect()->route('top100form.form.list',"frm_id=".$input_data["type_id"]);

	}

	public function editForm($id,Form $Form,Request $request){
		$Form=Form::find($id);
		$top_100_form=config("constant.TOP_100_FORM");
		$yes_no_arr=config("custom_config.yes_no_arr");


		if(!empty($Form->form_file))
			$Form->form_file_url = getUploadedFile($Form->form_file,'form_file');

		$fileConfig=config("upload_config.form_file");

		$top_id="";
		if(!empty($request->frm_id))
			$top_id=$request->frm_id;
		$placeholder="";
		$form_file_url="";





		if(!empty($Form->form_file_url))
		{
			$placeholder="/storage/app/public/form_file/".$fileConfig["placeholder"];
			$form_file_url=$Form->form_file_url;
		}
		$top_100_formObject=Top100Form::find($top_id);

		$is_latest_version=0;
		if($Form->id==$top_100_formObject["lastest_version_id"])
			$is_latest_version=1;


		$data_array = [
			'title'=>'Edit Form Version',
			'heading'=>'Edit Form Version',
			'breadcrumb'=>\Breadcrumbs::render('top100form.form.edit',['id'=> $Form->id]),
			'form'=> $Form,
			'form_file_url' => $form_file_url,
			'placeholder' => $placeholder,
			'frm_id' => $top_id,
			'top_100_form' => $top_100_form,
			'yes_no_arr' => $yes_no_arr,
			'is_latest_version' => $is_latest_version,

		];
		return view('admin.top100form.form.form',$data_array);

	}

	public function updateForm(FormFormRequest $request,Form $Form){

		try{				

			$input_data=$request->validate([
				'name' =>  'required|regex:/(^[a-zA-Z0-9 ]+$)/u|max:255|min:2',					
			]);
			$input_data=$request->input(); 


			if($input_data["lastest_version_id"])
			{
				$top_100_form=Top100Form::find($input_data["type_id"]);
				Top100Form::where('id',$input_data["type_id"])->update(['lastest_version_id' => $input_data["id"]]);
			}


			if(!empty($request->file('form_file'))){
				$upload_response = uploadFile($request,'form_file');
				if(!empty($upload_response['success'])){
					$input_data['form_file'] = $upload_response['data'];
				}
			}

			if(empty($Form->id))
			{
				//$Form->id=$input_data["id"];
				$Form=Form::find($input_data["id"]);
			}

			$Form = Form::saveData($input_data,$Form);

			if($Form){
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
		return redirect()->route('top100form.form.list',"frm_id=".$input_data["type_id"]);


	}

	public function destroyForm($id,Request $request){
		$Form=Form::find($id);

		$top_id="";
		if(!empty($request->frm_id))
			$top_id=$request->frm_id;

		try{
			$Form->delete();
			$response_type='success';
			$response_message='Form deleted successfully';
		}
		catch (Exception $e){
			$response_type='error';
			$response_message=$e->getMessage();
		}
		set_flash($response_type,$response_message);
		return redirect()->route('top100form.form.list',"frm_id=".$top_id);

	}


	public function listFaq(Top100Form $top_100_form,Request $request){

		$filter_data = $request->input();

		if(request()->ajax()) {
			$action_button_template='admin.datatable.actions';
			$status_button_template = 'admin.datatable.status';
			$model=Faq::query()->where("type_id","=",$top_100_form->id)->orderBy('created_at','desc');
			$table=Datatables()->of($model);

			if(!empty($filter_data['statusFilter'])){
				$model->where(['status'=>$filter_data['statusFilter']]);
			}
			$table->addIndexColumn();
			$table->addColumn('action','');
			$table->editColumn('action',function($row) use ($action_button_template,$top_100_form){				
				$buttons=[
					'edit'=>['route_url'=>'top100form.faq.edit', 'route_param'=>[$top_100_form->id,$row->id],'permission'=>'form-edit'],
					'delete'=>['route_url'=>'top100form.faq.destroy', 'route_param'=>[$top_100_form->id,$row->id],'permission'=>'form-delete'],
				];
				return view($action_button_template,compact('buttons'));
			});

			$table->editColumn('status',function($row) use ($status_button_template){
				$button_data=[
					'id'=>$row->id,
					'type'=>'faq',
					'status'=>$row->status,
					'action_class' => 'change-status',
					'permission'=>'form-edit'
				];
				return view($status_button_template,compact('button_data'));
			});

			return $table->make(true);
		}
		$data_array = [
			'title'=>'Manage Faq ',
			'heading'=>'Manage Faq ('.$top_100_form->name.')',
		];
		$data_array['add_new_button'] = [
			'label' => 'Add Faq ',
			'link'	=> route('top100form.faq.create',$top_100_form->id),
			'permission'=>'role-create'
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
		];      

		return view('admin.top100form.faq.form',$data_array); 

	}

	public function storeFaq(Top100Form $top_100_form,FaqFormRequest $request) {
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
			// 'breadcrumb'=>\Breadcrumbs::render('top100form.faq.edit',['id'=> $faq->id]),
			'faq'=> $faq,
			'top_100_form' => $top_100_form,
		];
		return view('admin.top100form.faq.form',$data_array);

	}

	public function updateFaq(FaqFormRequest $request,Top100Form $top_100_form,Faq $faq){
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
