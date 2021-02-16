<div class="modal fade folder_encript_update_modal my-default-modal" id="add-new-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Encript Folder Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert p-0 mb-0" id="address_mg_box_id"></div>

                {{ Form::open(['route' => ['front.general-settings-encript-folder-password-update'],'method'=>'post','class'=>'login-form','id' => 'general_settings_encript_folder_form_id','enctype'=>"multipart/form-data","autocomplete" => 'off']) }}
                {{Form::hidden('id',"",array('id' => 'addresslist_id'))}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">New Password</label>
                            {{ Form::password('folder_encript_new_password',array('id' => 'name','class' => 'form-control','placeholder' => 'Enter Name')) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Confirm Password</label>
                            {{ Form::password('folder_encript_confirm_password',array('id' => 'email','class' => 'form-control','placeholder' => 'Enter Email')) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="number">Current Password</label>
                            {{ Form::password('folder_encript_current_password',array('id' => 'phone','class' => 'form-control','placeholder' => 'Phone')) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button class="btn btn-success" id="general_settings_encript_folder_passwrod_btn_id">Update</button>
                    </div>
                </div>
                {{ Form::close() }}

            </div>


        </div>
    </div>
</div>