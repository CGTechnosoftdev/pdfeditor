<!-- Modal -->
<div class="modal fade more-options share-now" id="cust_share" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Share</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>The documents to be shared:</h6>
                <div class="shareable-file">
                    <img src="{{ asset('public/front/images/file-pdf.svg') }}">
                    <a href="#" id="shareDocumentLinkId" target="_blank">Get a Document Signed</a>
                </div>
                <div class="share-by">
                    <div class="alert  hide" id="userDocMsgConId"></div>
                    <ul class="nav nav-tabs">
                        <li><a class="active" id="share_by_link_1" data-toggle="tab" href="#email-link">Share by Email</a></li>
                        <li><a data-toggle="tab" id="share_by_link_2" href="#public-link">Share by Public Link</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="email-link" class="tab-pane fade in active show">


                            {{ Form::hidden("form_type",1,array("id" => 'form_typeid'))}}
                            {{ Form::open(['url' => '#','method'=>'post','class'=>'login-form','id' => 'user_document_send_email_form_id','enctype'=>"multipart/form-data"]) }}
                            {{ Form::hidden("user_document_id",0,array("id" => 'user_doc_id'))}}
                            {{ Form::hidden("share_type",1,array("id" => 'share_typeid1'))}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <!--<input type="email" class="form-control" id="email" placeholder="Enter email">-->
                                        {{ Form::text('email',null,array('id' => 'email','class' => 'form-control','placeholder' => 'Enter email')) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <!--<input type="text" class="form-control" id="name" placeholder="Enter Name">-->
                                        {{ Form::text('name',null,array('id' => 'name','class' => 'form-control','placeholder' => 'Enter Name')) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <div id="public-link" class="tab-pane fade">
                            {{ Form::open(['url' => '#','method'=>'post','class'=>'login-form','id' => 'user_document_share_link_form_id','enctype'=>"multipart/form-data"]) }}
                            {{ Form::hidden("share_type",2,array("id" => 'share_typeid2'))}}
                            {{ Form::hidden("user_document_id",0,array("id" => 'user_doc_id2'))}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="public_link">Public Link</label>
                                        <!--<input type="text" class="form-control" id="public_link" value="https://example.com" placeholder="https://example.com">-->
                                        {{form::text("link","https://example.com",array("class" => "form-control","placeholder" => "https://example.com"))}}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="share-link-btns">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success" id="share_button_id">Share</button>
                            <button class="btn btn-outline-success" id="advance_settings_id">Advance Settings</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>