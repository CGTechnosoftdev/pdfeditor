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
					'manage' =>['route_url'=>'top100form.form.list','label' => '', 'route_param'=>["frm_id=".$row->id],'permission'=>'top100form.form.list'],
					'manage2' =>['route_url'=>'top100form.faq.list','label' => '', 'route_param'=>["frm_id=".$row->id],'permission'=>'top100form.faq.list'],
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

        // dd($businessCategory);
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
	   
	

		$top_id="11";
		if(!empty($_GET["frm_id"]))
		$top_id=$_GET["frm_id"];
   
		
		   $filter_data = $request->input();
		   
		   if(request()->ajax()) {
			   $top_id="1";
		if(!empty($_GET["frm_id"]))
		$top_id=$_GET["frm_id"];
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
		   $data_array = [
			   'title'=>'Manage Form Verion',
			   'heading'=>'Manage Form Verion',
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
		   return view('admin.form.index',$data_array);

	}

	public function createForm(){
			//
			$top_id="11";
			$top_100_form=config("constant.TOP_100_FORM");
			
			if(!empty($_GET["frm_id"]))
			$top_id=$_GET["frm_id"];
			$data_array = [
				'title'=>'Add Form Version',
				'heading'=>'Add Form Version',
				'breadcrumb'=>\Breadcrumbs::render('top100form.form.create'),
				'frm_id' => $top_id,
				'top_100_form' => $top_100_form,
			];      
		
			return view('admin.form.form',$data_array); 

	}

	public function storeForm(FormFormRequest $request) {

		try{
			$input_data=$request->input(); 
		//	dd($input_data);
		if(!empty($request->file('form_file'))){
    		$upload_response = uploadFile($request,'form_file');
    		if(!empty($upload_response['success'])){
    			$input_data['form_file'] = $upload_response['data'];
    		}
		}
		
            $businessCategory = Form::saveData($input_data);
          
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

	public function editForm($id,Form $Form){
		$Form=Form::find($id);
		$top_100_form=config("constant.TOP_100_FORM");
	
		$Form->form_file_url = getUploadedFile($Form->form_file,'form_file');

		$fileConfig=config("upload_config.form_file");
		//dd($fileConfig);
		$top_id="11";
		if(!empty($_GET["frm_id"]))
		$top_id=$_GET["frm_id"];

		if(!empty($Form->form_file_url))
		{
			$Form->form_file_url=preg_replace("/form_file/","app/public/form_file",$Form->form_file_url);
		}
		//
		$data_array = [
			'title'=>'Edit Form Version',
			'heading'=>'Edit Form Version',
			'breadcrumb'=>\Breadcrumbs::render('top100form.form.edit',['id'=> $Form->id]),
			'form'=> $Form,
			'fileConfig' => $fileConfig,
			'frm_id' => $top_id,
			'top_100_form' => $top_100_form,
		];
	
	

		return view('admin.form.form',$data_array);

	}

	public function updateForm(FormFormRequest $request,Form $Form){

		try{				
			$input_data=$request->input(); 
			
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

	public function destroyForm($id){
		$Form=Form::find($id);

		$top_id="11";
		if(!empty($_GET["frm_id"]))
		$top_id=$_GET["frm_id"];
		
		try{
           // dd($business_category);
          
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

//for faqs

public function listFaq(Request $request){
	   
	

	$top_id="11";
	if(!empty($_GET["frm_id"]))
	$top_id=$_GET["frm_id"];

	
	   $filter_data = $request->input();
	   
	   if(request()->ajax()) {
		   $top_id="1";
	if(!empty($_GET["frm_id"]))
	$top_id=$_GET["frm_id"];
		   $action_button_template='admin.datatable.actions';
		   $status_button_template = 'admin.datatable.status';
		   $model=Faq::query()->where("type_id","=",$top_id)->orderBy('created_at','desc');
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
				   'edit'=>['route_url'=>'top100form.faq.edit', 'route_param'=>[$row->id,"frm_id=".$top_id],'permission'=>'form-edit'],
				   'delete'=>['route_url'=>'top100form.faq.destroy', 'route_param'=>[$row->id,"frm_id=".$top_id],'permission'=>'form-delete'],
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
		   'heading'=>'Manage Faq',
		   'breadcrumb'=>\Breadcrumbs::render('top100form.faq.list'),
		   'top_id' => $top_id,
	   ];
	   $data_array['add_new_button'] = [
		   'label' => 'Add Faq ',
		   'link'	=> route('top100form.faq.create',"frm_id=$top_id"),
		   'permission'=>'role-create'
	   ];
	   $data_array['data_table'] = [
		   'data_source' => route('top100form.faq.list'),
		   'data_column_config' => config('datatable_column.faq'),
	   ];
	   return view('admin.form.index',$data_array);

}

public function createFaq(){
		//
		$top_id="11";
		$top_100_form=config("constant.TOP_100_FORM");
		
		if(!empty($_GET["frm_id"]))
		$top_id=$_GET["frm_id"];
		$data_array = [
			'title'=>'Add Faq',
			'heading'=>'Add Faq',
			'breadcrumb'=>\Breadcrumbs::render('top100form.faq.create'),
			'frm_id' => $top_id,
			'top_100_form' => $top_100_form,
		];      
	
		return view('admin.faq.form',$data_array); 

}

public function storeFaq(FaqFormRequest $request) {

	try{
		$input_data=$request->input(); 
	//	dd($input_data);
	if(!empty($request->file('form_file'))){
		$upload_response = uploadFile($request,'form_file');
		if(!empty($upload_response['success'])){
			$input_data['form_file'] = $upload_response['data'];
		}
	}
	
		$businessCategory = Faq::saveData($input_data);
	  
		if($businessCategory){
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
	return redirect()->route('top100form.faq.list',"frm_id=".$input_data["type_id"]);

}

public function editFaq($id){
	$faq=Faq::find($id);
	$top_100_form=config("constant.TOP_100_FORM");




	//dd($fileConfig);
	$top_id="11";
	if(!empty($_GET["frm_id"]))
	$top_id=$_GET["frm_id"];


	//
	$data_array = [
		'title'=>'Edit Faq',
		'heading'=>'Edit Faq',
		'breadcrumb'=>\Breadcrumbs::render('top100form.faq.edit',['id'=> $faq->id]),
		'form'=> $faq,
	
		'frm_id' => $top_id,
		'top_100_form' => $top_100_form,
	];



	return view('admin.faq.form',$data_array);

}

public function updateFaq(FaqFormRequest $request){

	try{				
		$input_data=$request->input(); 
		
		if(empty($Form->id))
		{
			//$Form->id=$input_data["id"];
			$faq=Faq::find($input_data["id"]);
		}
		
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
	//return redirect()->route('form.index');
	return redirect()->route('top100form.faq.list',"frm_id=".$input_data["type_id"]);


}

public function destroyFaq($id){
	$faq=Faq::find($id);

	$top_id="11";
	if(!empty($_GET["frm_id"]))
	$top_id=$_GET["frm_id"];
	
	try{
	   // dd($business_category);
	  
	   $faq->delete();
		$response_type='success';
		$response_message='Faq deleted successfully';
	}
	catch (Exception $e){
		$response_type='error';
		$response_message=$e->getMessage();
	}
	set_flash($response_type,$response_message);
	return redirect()->route('top100form.faq.list',"frm_id=".$top_id);

}


}
