<!-- Modal -->
<div class="modal fade more-options add_Address" id="cust_share" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Address</h6>

                <div class="share-by">
                    <div class="alert  hide" id="userDocMsgConId"></div>
                    <ul class="nav nav-tabs">
                        <li><a class="active" id="share_by_link_1" data-toggle="tab" href="#email-link">Share by Email</a></li>
                        <li><a data-toggle="tab" id="share_by_link_2" href="#public-link">Share by Public Link</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="email-link" class="tab-pane fade in active show">



                            {{ Form::open(['url' => '#','method'=>'post','class'=>'login-form','id' => 'email_address_add_form_id','enctype'=>"multipart/form-data"]) }}
                            {{Form::hidden('id',"",array('id' => 'addresslist_id'))}}

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Name</label>
                                        <!--<input type="email" class="form-control" id="email" placeholder="Enter email">-->
                                        {{ Form::text('name',null,array('id' => 'name','class' => 'form-control','placeholder' => 'Enter Name')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <!--<input type="text" class="form-control" id="name" placeholder="Enter Name">-->
                                        {{ Form::text('email',null,array('id' => 'email','class' => 'form-control','placeholder' => 'Enter Email')) }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Phone</label>
                                        <!--<input type="email" class="form-control" id="email" placeholder="Enter email">-->
                                        {{ Form::text('phone',null,array('id' => 'phone','class' => 'form-control','placeholder' => 'Phone')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Fax</label>
                                        <!--<input type="text" class="form-control" id="name" placeholder="Enter Name">-->
                                        {{ Form::text('fax',null,array('id' => 'fax','class' => 'form-control','placeholder' => 'Fax')) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>

                    </div>
                    <div class="share-link-btns">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success" id="add_email_address_btn_id">Add</button>
                            <button class="btn btn-success" id="edit_email_address_btn_id">Edit</button>
                            <button class="btn btn-outline-success" id="advance_settings_id">Advance Settings</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>