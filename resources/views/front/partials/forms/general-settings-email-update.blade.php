<div class="modal fade gs_email_update_modal my-default-modal" id="add-new-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert" id="address_mg_box_id"></div>
                {{ Form::open(['route' => ['front.general-settings-email-update'],'method'=>'post','class'=>'login-form','id' => 'general_settings_email_form_id','enctype'=>"multipart/form-data","autocomplete" => 'off']) }}
                {{Form::hidden('id',"",array('id' => 'addresslist_id'))}}
                {{Form::hidden('email_phone_token',($token??""),['id' => 'email_phone_token' ])}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">New Email</label>
                            {{ Form::text('gs_email_new_email',null,array('id' => 'name','class' => 'form-control','placeholder' => 'Enter Name')) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Retype Email</label>
                            {{ Form::text('gs_email_retype_email',null,array('id' => 'email','class' => 'form-control','placeholder' => 'Enter Email')) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="number">Current Password</label>
                            {{ Form::password('gs_email_current_password',null,array('id' => 'phone','class' => 'form-control','placeholder' => 'Phone')) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success" id="general_seeting_email_btn_id">Update</button>

                    </div>
                </div>
                {{ Form::close() }}

            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>