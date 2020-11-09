<?php
namespace App\Http\Controllers\Admin;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\SubscriptionPlanFormRequest;

class SubscriptionPlanController extends AdminBaseController
{
	function __construct()
	{
		$this->middleware('permission:subscription-plan-list|subscription-plan-create|subscription-plan-edit|subscription-plan-delete');
		$this->middleware('permission:subscription-plan-create', ['only' => ['create','store']]);
		$this->middleware('permission:subscription-plan-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:subscription-plan-delete', ['only' => ['destroy']]);    	
	}

	public function index(Request $request)
	{
		$filter_data = $request->input();
		if(request()->ajax()) {
			$action_button_template='admin.datatable.actions';
			$status_button_template = 'admin.datatable.status';
			$model=SubscriptionPlan::query()->get();
			$table=Datatables()->of($model);
			if(!empty($filter_data['statusFilter'])){
				$model->where(['status'=>$filter_data['statusFilter']]);
			}
			$table->addIndexColumn();
			$table->addColumn('action','');
			$table->editColumn('action',function($row) use ($action_button_template){
				$buttons=[
					'view'=>['route_url'=>'subscription-plan.show', 'route_param'=>[$row->id]],
					'edit'=>['route_url'=>'subscription-plan.edit', 'route_param'=>[$row->id],'permission'=>'subscription-plan-edit'],
					'delete'=>['route_url'=>'subscription-plan.destroy', 'route_param'=>[$row->id],'permission'=>'subscription-plan-delete'],
				];
				return view($action_button_template,compact('buttons'));
			});

			$table->editColumn('status',function($row) use ($status_button_template){
				$button_data=[
					'id'=>$row->id,
					'type'=>'subscription_plan',
					'status'=>$row->status,
					'action_class' => 'change-status',
					'permission'=>'subscription-plan-edit'
				];
				return view($status_button_template,compact('button_data'));
			});

			return $table->make(true);
		}
		$data_array = [
			'title'=>'Subscription Plan',
			'heading'=>'Subscription Plan',
			'breadcrumb'=>\Breadcrumbs::render('subscription-plan.index'),
		];
		$data_array['add_new_button'] = [
			'label' => 'Add Subscription Plan',
			'link'	=> route('subscription-plan.create'),
			'permission'=>'subscription-plan-create'
		];
		$data_array['data_table'] = [
			'data_source' => route('subscription-plan.index'),
			'data_column_config' => config('datatable_column.subscription_plan'),
		];
		return view('admin.subscription-plan.index',$data_array);
	}

	public function create()
	{  
		$data_array = [
			'title'=>'Add Subscription Plan',
			'heading'=>'Add Subscription Plan',
			'breadcrumb'=>\Breadcrumbs::render('subscription-plan.create'),
		];		
		return view('admin.subscription-plan.form',$data_array);

	}


	public function store(SubscriptionPlanFormRequest $request) 
	{
		try{
			$input_data=$request->input(); 			
			$business_category = SubscriptionPlan::saveData($input_data);
			if($business_category){
				$response_type='success';
				$response_message='Subscription Plan added successfully';
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
		return redirect()->route('subscription-plan.index');
	}

	public function edit(SubscriptionPlan $subscription_plan)
	{
	
		$data_array = [
			'title'=>'Edit Subscription Plan',
			'heading'=>'Edit Subscription Plan',
			'breadcrumb'=>\Breadcrumbs::render('subscription-plan.edit',['id'=> $subscription_plan->id]),
			'subscription_plan'=> $subscription_plan,
		];
		return view('admin.subscription-plan.form',$data_array);
	}

	
	public function update(SubscriptionPlanFormRequest $request,SubscriptionPlan $subscription_plan)
	{
		try{			
			$input_data=$request->input(); 
			$business_category = SubscriptionPlan::saveData($input_data,$subscription_plan);
			if($business_category){
				$response_type='success';
				$response_message='Subscription Plan edited successfully';
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
		return redirect()->route('subscription-plan.index');
	}

		/**
	 * [show description]
	 * @author Akash Sharma
	 * @date   2020-11-02
	 * @param  User       $sub_admin [description]
	 * @return [type]                [description]
	 */
	public function show(SubscriptionPlan $subscription_plan){
		$data_array = [
			'title'=>$subscription_plan->name." Detail",
			'heading'=>$subscription_plan->name." Detail",
			'breadcrumb'=>\Breadcrumbs::render('subscription-plan.show',$subscription_plan->id,$subscription_plan->name),
			'subscription_plan' => $subscription_plan
		];
		$data_array['back_button'] = [
			'label' => 'Back',
			'link'  => route('subscription-plan.index'),
		];
		return view('admin.subscription-plan.view',$data_array);
	}
	
	public function destroy(SubscriptionPlan $subscription_plan)
	{
		try{
			if($subscription_plan->delete()){
				$response_type='success';
				$response_message='Subscription Plan deleted successfully';
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
		return redirect()->route('subscription-plan.index');
	}


}
