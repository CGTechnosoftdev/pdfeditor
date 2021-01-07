@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")

<!-- Content Header (Page header) -->
<section class="content-header share-allert">
    <div class="title">
        <h2>LinkToFill</h2>
    </div>
    <div class="share-allert-text">
        <p>Distribute your documents to be filled by anyone on any device. See the options below to choose the best way to distribute your documents and get them completed.</p>
    </div>
</section>

<!-- Main content -->
<section class="content">
    {{ Form::open(['route' => 'front.publish-link-to-fill','method'=>'post','id'=>'link-to-fill-form','enctype'=>"multipart/form-data"]) }}
    <div class="advance-settings-part non-published">
        <h3>
            <a class="" href="#you-are-sharing" aria-expanded="true" aria-controls="you-are-sharing">
                <img class="icon" src="{{ asset('public/front/images/file-document-outline.svg') }}"> Document Template to make publicly fillable <span><img src="{{ asset('public/front/images/info-i.svg') }}"></span>
            </a>
        </h3>
        <div class="collapse show" id="you-are-sharing">
            <div class="advance-settings-content">
                <div class="row">
                    <div class="col-lg-10 col-md-8">
                        <div class="single-document single-doc-signed">
                            <div class="doc-dots">
                                <button><i class="fas fa-bars"></i></button>
                            </div>
                            <div class="doc-img">
                                <img src="{{ $document->thumbnail_url }}" class="user-image" alt="{{ $document->formatted_name }}">
                            </div>
                            <div class="doc-content">
                                <h5>{{ $document->formatted_name }}</h5>
                                <div class="last-activity">Last update: {{ changeDateTimeFormat($document->updated_at) }}</div>
                            </div>
                            <!-- <div class="doc-date-and-dismiss">
                                <a href="" class="edit-fillable-btn"><i class="fas fa-edit"></i> Edit Fillable Fields</a>
                                <button><i class="fas fa-times"></i></button>
                            </div> -->
                            <div></div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2 col-md-4">
                        <div class="add-single-doc-signed">
                            <a href=""><i class="fas fa-plus-circle"></i> Add Another Document</a>
                        </div>
                    </div> -->
                </div>
            </div>

            <section class="general-settings-tabs linktofill-settings">
                <h4 class="active">
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/security.svg') }}"></div>
                        <div class="tab-content">
                            <span>Set Security Options</span>
                            <p>Define Security Settings</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options">
                            <div class="title">Password Protection
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                {{ Form::hidden('security_method[document_password]','',['id'=>'document_password']) }}
                                <button class="set-password" data-toggle="modal" data-target="#set-password-modal">
                                    <i class="fas fa-key"></i> Set Password
                                </button>
                                <button class="remove-password d-none">
                                    <i class="fas fa-key"></i> Remove Password
                                </button>
                            </div>
                        </div>
                        <div class="single-security-options">
                            <div class="title">HIPAA Compliance
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('security_method[hipaa_compliance]','1',null,['id'=>'hipaa_compliance','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="hipaa_compliance"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Document ID
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('security_method[document_id]','1',null,['id'=>'document_id','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="document_id"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Public Access Expires
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('security_method[public_access_expire_status]','1',null,['id'=>'public_access_expire_status','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="public_access_expire_status"></label>
                                </div>

                            </div>
                            <div class="other-options ml-20">
                                {{ Form::text('security_method[public_access_expire]',old('public_access_expire'),['placeholder'=>'Expiration Date','class'=>"form-control mw-150 calendar datepicker",'id'=>'public_access_expire','autocomplete'=>'off','disabled'=>true]) }}

                            </div>
                        </div>
                        <div class="single-security-options">
                            <div class="title">Electronic record and signature disclosure
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('security_method[electronic_record_sign_disclosure]','1',null,['id'=>'electronic_record_sign_disclosure','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="electronic_record_sign_disclosure"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Signature Agreement
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('security_method[signature_agreement]','1',null,['id'=>'signature_agreement','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="signature_agreement"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <h4>
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/require-from-recipient.svg') }}"></div>
                        <div class="tab-content">
                            <span>Require from Recipient</span>
                            <p>Verify Recipient Identity</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options">
                            <div class="title">Email Address
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('authentication_method[email_address]','1',null,['id'=>'email_address','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="email_address"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Name
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('authentication_method[name]','1',null,['id'=>'name','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="name"></label>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Authantication Method
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="authentication-method-disc">
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        {{ Form::checkbox('authentication_method[phone_number]','1',null,['id'=>'phone_number','class'=>'custom-control-input']) }}
                                        <label class="custom-control-label" for="phone_number">Phone Number </label>
                                    </div>
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        {{ Form::checkbox('authentication_method[social_media]','1',null,['id'=>'social_media','class'=>'custom-control-input']) }}
                                        <label class="custom-control-label" for="social_media">Social Media <span class="fb"><i class="fab fa-facebook-f"></i></span> <span class="google"><img src="{{ asset('/public/front/images/google_g.svg') }}"></span></label>
                                    </div>
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                        {{ Form::checkbox('authentication_method[photo]','1',null,['id'=>'photo','class'=>'custom-control-input']) }}
                                        <label class="custom-control-label" for="photo">Photo</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="single-security-options">
                            <div class="title">Authanticational Documents
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="add-document-names">
                                    <div class="add-tag-input">
                                        <input type="text" class="form-control" placeholder="Add document name">
                                        <button><i class="fas fa-plus"></i></button>
                                    </div>
                                    <div class="tags-list">
                                        <span class="tag">My docs <span data-role="remove"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <h4>
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/user-card.svg') }}"></div>
                        <div class="tab-content">
                            <span>Create a Welcome Message and Set Redirect</span>
                            <p>Introduce Yourself to Recipients</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">Your Logo</div>
                            <div class="other-options">
                                <div class="personalize-invitation-content">
                                    <p>Replace the default PDF Writer logo with your own (optional).</p>
                                    <ul class="template-types logo-type">
                                        <li class="p-0">
                                            <div id="UploadLogo">
                                                <upload-gambar></upload-gambar>
                                            </div>
                                        </li>
                                        <li>
                                            <img src="{{ asset('public/front/images/logo-blue.png') }}">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">Welcome Message</div>
                            <div class="other-options w-100">
                                <div class="form-group">
                                    {{ Form::textarea('personalize_invitation_data[welcome_message]',null,['class'=>'form-control w-100','placeholder'=>"Please make sure that all information in this document is correct before submitting. If you have any questions about using PDF Writer, please click the question mark."]) }}
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">Your Business Card</div>
                            <div class="other-options w-100">

                                <div class="row">
                                    <div class="col-lg-12 col-xl-4">
                                        <div class="avatar-upload">
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url({{ asset('public/front/images/avatar.svg') }});">
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                {{ Form::file('business_card_image', ['id' => 'imageUpload','accept'=>".png, .jpg, .jpeg"]) }}
                                                <!-- <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" /> -->
                                                <label for="imageUpload">Add Picture</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-8">
                                        <div class="personalize-invitation-content">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::text('personalize_invitation_data[business_card][first_name]','',['placeholder'=>'First Name','class'=>"form-control",'id'=>'business_card_first_name']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::text('personalize_invitation_data[business_card][last_name]','',['placeholder'=>'Last Name','class'=>"form-control",'id'=>'business_card_last_name']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::text('personalize_invitation_data[business_card][job_title]','',['placeholder'=>'Job Title','class'=>"form-control",'id'=>'business_card_job_title']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::text('personalize_invitation_data[business_card][company]','',['placeholder'=>'Company','class'=>"form-control",'id'=>'business_card_company']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::text('personalize_invitation_data[business_card][email]','',['placeholder'=>'johnsmith@gmail.com','class'=>"form-control",'id'=>'business_card_email']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::text('personalize_invitation_data[business_card][phone_number]','',['placeholder'=>'Phone number','class'=>"form-control",'id'=>'business_card_phone_number']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::text('personalize_invitation_data[business_card][fax_number]','',['placeholder'=>'Fax number','class'=>"form-control",'id'=>'business_card_fax_number']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{ Form::text('personalize_invitation_data[business_card][website]','',['placeholder'=>'Website','class'=>"form-control",'id'=>'business_card_website']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Introduction Video (URL)</div>
                            <div class="other-options w-100">
                                <div class="form-group">
                                    {{ Form::text('personalize_invitation_data[introduction_video]','',['placeholder'=>'https://','class'=>"form-control w-100",'id'=>'introduction_video']) }}
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Redirect After Submission
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options w-100">
                                <div class="form-group">
                                    {{ Form::text('personalize_invitation_data[redirect_path]','',['placeholder'=>'Http://www.pdfwriter.com','class'=>"form-control w-100",'id'=>'redirect_path']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/access-privilege.svg') }}"></div>
                        <div class="tab-content">
                            <span>Set Signing and Access Privilege</span>
                            <p>Customize Access to Your Document</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">User Can</div>
                            <div class="other-options">
                                <div class="personalize-invitation-content mb-0">
                                    <ul class="template-types li-0">
                                        <li>
                                            <label for="user_can_edit">
                                                {{ Form::radio('access_privileges[user_can]',config('constant.USER_CAN_EDIT_AND_SIGN'),1,['id'=>'user_can_edit']) }}
                                                Edit & Sign
                                            </label>
                                        </li>
                                        <li>
                                            <label for="user_can_sign">
                                                {{ Form::radio('access_privileges[user_can]',config('constant.USER_CAN_SIGN'),1,['id'=>'user_can_sign']) }}
                                                Sign Only
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Enforce Required Fields</div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('access_privileges[enforce_required_fields]','1',null,['id'=>'enforce_required_fields','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="enforce_required_fields"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Signature Stamp
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('access_privileges[signature_stamp]','1',null,['id'=>'signature_stamp','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="signature_stamp"></label>
                                </div>

                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Can get a copy
                                <span class="tab-info">
                                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                                </span>
                            </div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('access_privileges[can_get_copy]','1',null,['id'=>'can_get_copy','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="can_get_copy"></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <h4>
                    <div class="d-flex align-items-center">
                        <div class="tab-icon"><img src="{{ asset('public/front/images/bell.svg') }}"></div>
                        <div class="tab-content">
                            <span>Complete Document Notification and Storage</span>
                            <p>Stay in the Loop</p>
                        </div>
                        <div class="tab-info">
                            <img src="{{ asset('public/front/images/info-i.svg') }}">
                        </div>
                    </div>
                </h4>
                <div class="setting-tab-content">
                    <div class="security-options">
                        <div class="single-security-options personalize-invitation-part">
                            <div class="title">Send Notification to</div>
                            <div class="other-options select-2">
                                <div class="add-document-names">
                                    <div class="add-tag-input">
                                        {!! Form::select('document_notification[notify_to][]',[],[], ['class'=>'js-states form-control select2-token','multiple'=>true]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="other-options ml-20">
                                <button class="btn address-book-btn"><i class="fas fa-address-book"></i> Address Book</button>
                            </div>
                        </div>

                        <div class="single-security-options">
                            <div class="title">Attach Document</div>
                            <div class="other-options">
                                <div class="tg-list-item">
                                    {{ Form::checkbox('document_notification[attach_document]','1',null,['id'=>'attach_document','class'=>'tgl tgl-light']) }}
                                    <label class="tgl-btn" for="attach_document"></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="advance-settings-btns">
            {!! Form::submit('Publish',['class'=>'share-btn']) !!}
            <!-- <a href="#" class="share-btn">Publish</a> -->
            <!-- <a href="#" class="my-doc-btn">My Docs</a> -->
            <div class="d-inline-block ml-3">
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="checkbox-4">
                    <label class="custom-control-label" for="checkbox-4">Use as your default LinkToFill settings</label>
                </div>
            </div>
            <!-- <a href="#" class="btn btn-outline-success float-right">Test My Document</a> -->
        </div>
    </div>
    {{ Form::close() }}
    <div class="advance-settings-part d-none published">
        <h3>
            <a class="" href="#recipients" aria-expanded="true" aria-controls="recipients">
                <img class="icon" src="{{ asset('public/front/images/file-document-outline.svg') }}"> Distribute your Document
                <span>
                    <img src="{{ asset('public/front/images/info-i.svg') }}">
                </span>
            </a>
        </h3>
        <div class="collapse show" id="recipients">
            <div class="advance-settings-content published-link-div disable-div">
                <div class="share-by">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <p>This URL will open your document in any desktop or mobile browser. Use this link to access and share your document.</p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="link-to-fill" placeholder="Http://">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="generate-url-btns">
                                    <li>
                                        <a class="outline-btn mb-3" data-clipboard-demo="" data-clipboard-target="#link-to-fill" onclick="return false;" href="">
                                            <i class="far fa-copy"></i> Copy Link
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-12">
                                <p>Post your document's URL on Facebook or Twitter</p>
                            </div>
                            <div class="col-md-12">
                                <ul class="generate-url-btns">
                                    <li><a class="facebook" id="facebook-share" target="_blank" href=""><i class="fab fa-facebook-f"></i> Share on Facebook</a></li>
                                    <li><a class="twitter" id="twitter-share" target="_blank" href=""><i class="fab fa-twitter"></i> Share on Twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Modal -->
<div class="modal fade more-options create-folder" id="set-password-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" name="document-new-password" class="form-control" id="document-new-password">
                </div>

                <div class="share-link-btns">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" id="set-password-submit">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
@section('additionalcss')
<link href="{{ asset('public/front/css/select2.min.css') }}" rel="stylesheet" />
@append
@section('additionaljs')
<script src="{{ asset('public/front/js/vue.min.js') }}"></script>
<script src="{{ asset('public/front/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".select2-token").select2({
            placeholder: "Enter a tag",
            allowClear: true,
            tags: true,
            tokenSeparators: [',']
        });
        $(document).on('click', '.set-password', function(e) {
            e.preventDefault();
        });
        $(document).on('click', '#set-password-submit', function(e) {
            e.preventDefault();
            var password = $('#document-new-password').val();
            if (password.length > 0) {
                $('.set-password').addClass('d-none');
                $('.remove-password').removeClass('d-none');
                $('#document_password').val(password);
                $('#document-new-password').val('');
                toastr.success("Password set successfully");
                $('#set-password-modal').modal('hide');
            } else {
                toastr.error("Password cannot be empty");
            }
        });
        $(document).on('click', '.remove-password', function(e) {
            e.preventDefault();
            $('.set-password').removeClass('d-none');
            $('.remove-password').addClass('d-none');
            $('#document_password').val('');
            toastr.success("Password removed successfully");

        });

        $(document).on('change', '#public_access_expire_status', function(e) {
            e.preventDefault();
            $('#public_access_expire').val('');
            if ($(this).is(":checked")) {
                $('#public_access_expire').attr('disabled', false);
            } else {
                $('#public_access_expire').attr('disabled', true);
            }
        });

        $('.datepicker').datepicker({
            autoclose: true,
            format: "{{ (config('custom_config.js_date_format_arr')[config('general_settings.date_format')]) }}",
            startDate: "-1",
            todayHighlight: true,
        });

        $("#link-to-fill-form").submit(function(e) {
            e.preventDefault();
            blockUI();
            var formData = new FormData(this);
            formData.append("document", "{{$document->encrypted_id}}");
            $.ajax({
                url: "{{route('front.publish-link-to-fill')}}",
                type: "post",
                dataType: 'json',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    var response_data = response.data;
                    $('#link-to-fill').val(response_data.publish_link);
                    $('#facebook-share').attr('href', response_data.facebook_share_link);
                    $('#twitter-share').attr('href', response_data.twitter_share_link);
                    $('.non-published').addClass('d-none');
                    $('.published').removeClass('d-none');
                    $('.published-link-div').removeClass('disable-div');
                    toastr.success(response.message);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                },
                complete: function() {
                    unblockUI();
                },
            });
        });
    });
    ///////////// Image Upload and Preview /////////////
    Vue.component('upload-gambar', {
        template: `
  <span @click="openUpload">
  	<img ref="preview" :src="showImage" style="max-width: 200px; max-height: 70px">
    <input ref="input" name="logo" @change="previewImage" type="file" id="file-field" accept="image/*" style="display: none"/>
  </span>`,

        data: () => {
            return {
                showImage: "{{ asset('public/front/images/add-new-logo.png') }} "
            }
        },

        methods: {
            openUpload() {
                this.$refs.input.click()
            },

            previewImage() {
                var reader = new FileReader()
                reader.readAsDataURL(this.$refs.input.files[0])

                reader.onload = e => {
                    this.showImage = e.target.result
                }
            }
        }
    });
    new Vue({
        el: '#UploadLogo'
    })
</script>
@append