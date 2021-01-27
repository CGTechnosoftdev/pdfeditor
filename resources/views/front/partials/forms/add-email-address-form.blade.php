<div class="modal fade add_Address" id="add-new-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert" id="address_mg_box_id"></div>
                {{ Form::open(['url' => '#','method'=>'post','class'=>'login-form','id' => 'email_address_add_form_id','enctype'=>"multipart/form-data"]) }}
                {{Form::hidden('id',"",array('id' => 'addresslist_id'))}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            {{ Form::text('name',null,array('id' => 'name','class' => 'form-control','placeholder' => 'Enter Name')) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            {{ Form::text('email',null,array('id' => 'email','class' => 'form-control','placeholder' => 'Enter Email')) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="number">Phone Number</label>
                            {{ Form::text('phone',null,array('id' => 'phone','class' => 'form-control','placeholder' => 'Phone')) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            {{ Form::text('fax',null,array('id' => 'fax','class' => 'form-control','placeholder' => 'Fax')) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success" id="add_email_address_btn_id">Add</button>
                        <button class="btn btn-success" id="edit_email_address_btn_id">Edit</button>
                    </div>
                </div>
                {{ Form::close() }}

            </div>
            <div class="modal-footer">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <span>Or Import Contact From</span>

                    <div class="social-links">
                        <ul>
                            <li>
                                <a href="#" data-url="{{$googleImportUrl}}" id="importGmailContactsid"><img src="{{asset('public/front/images/mail-icon.svg')}}"></a>
                            </li>

                            <li>
                                <a href="#"><img src="{{asset('public/front/images/yahoo.svg')}}"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>