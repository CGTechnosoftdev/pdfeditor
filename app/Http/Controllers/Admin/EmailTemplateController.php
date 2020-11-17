<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\EmailTemplateFormRequest;

class EmailTemplateController extends AdminBaseController
{
    /**
     * [__construct description]
     * @author Akash Sharma
     * @date   2020-11-17
     */
    function __construct()
    {
        $this->middleware('permission:email-template-list|email-template-create|email-template-edit|email-template-delete');
        $this->middleware('permission:email-template-edit', ['only' => ['edit','update']]);
        // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    }
    
    public function index(Request $request)
    {
        $filter_data = $request->input();
        if(request()->ajax()) {
            $action_button_template='admin.datatable.actions';
            $status_button_template = 'admin.datatable.status';
            $model=EmailTemplate::query();
            $table=Datatables()->of($model);
            if(!empty($filter_data['statusFilter'])){
                $model->where(['status'=>$filter_data['statusFilter']]);
            }
            $table->addIndexColumn();
            $table->addColumn('action','');
            $table->editColumn('action',function($row) use ($action_button_template){
                $buttons=[
                    'edit'=>['route_url'=>'email-template.edit', 'route_param'=>[$row->id],'permission'=>'email-template-edit'],
                ];
                return view($action_button_template,compact('buttons'));
            });

            $table->editColumn('status',function($row) use ($status_button_template){
                $button_data=[
                    'id'=>$row->id,
                    'type'=>'email-template',
                    'status'=>$row->status,
                    'action_class' => 'change-status',
                    'permission'=>'email-template-edit'
                ];
                return view($status_button_template,compact('button_data'));
            });

            return $table->make(true);
        }

        $data_array = [
            'title'=>'Email Templates',
            'heading'=>'Manage Email Templates',
            'breadcrumb'=>\Breadcrumbs::render('email-template.index'),
        ];
        $data_array['data_table'] = [
            'data_source' => route('email-template.index'),
            'data_column_config' => config('datatable_column.email_template'),
        ];
        return view('admin.email-template.index',$data_array);
    }

    /**
     * [edit description]
     * @author Akash Sharma
     * @date   2020-11-17
     * @param  EmailTemplate       $email_template [description]
     * @return [type]           [description]
     */
    public function edit(EmailTemplate $email_template)
    {
        $data_array = [
            'title'=>'Edit Email Template',
            'heading'=>'Edit Email Template',
            'breadcrumb'=>\Breadcrumbs::render('email-template.edit',['id'=>$email_template->id]),
            'email_template'=>$email_template
        ];
        return view('admin.email-template.form',$data_array);
    }

    /**
     * [update description]
     * @author Akash Sharma
     * @date   2020-11-17
     * @param  EmailTemplateFormRequest $request [description]
     * @param  EmailTemplate             $email_template    [description]
     * @return [type]                    [description]
     */
    public function update(EmailTemplateFormRequest $request,EmailTemplate $email_template)
    {
        try{
            $input_data=$request->input(); 
            $email_template = EmailTemplate::saveData($input_data,$email_template);
            if($email_template){
                $response_type='success';
                $response_message='Email Template edited successfully';
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
        return redirect()->route('email-template.index');
    }
}
