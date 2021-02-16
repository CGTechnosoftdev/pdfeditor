<div class="modal fade gs_phone_update_modal my-default-modal" id="add-new-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Phone</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert p-0 mb-0" id="address_mg_box_id"></div>
                {{ Form::open(['route' => ['front.general-settings-phone-update'],'method'=>'post','class'=>'login-form','id' => 'general_settings_phone_form_id','enctype'=>"multipart/form-data","autocomplete" => 'off']) }}
                {{Form::hidden('id',"",array('id' => 'addresslist_id'))}}
                {{Form::hidden('email_phone_token',($token??""),['id' => 'email_phone_token' ])}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">New Phone</label>
                            {{ Form::text('gs_phone_new_phone',null,array('id' => 'name','class' => 'form-control','placeholder' => 'Enter Name')) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="number">Current Password</label>
                            {{ Form::password('gs_phone_current_password',array('id' => 'phone','class' => 'form-control','placeholder' => 'Phone')) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success" id="general_settings_phone_btn_id">Update</button>
                    </div>
                </div>
                {{ Form::close() }}

            </div>


        </div>
    </div>
</div>