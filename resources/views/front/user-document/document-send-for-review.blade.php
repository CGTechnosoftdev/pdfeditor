@extends('layouts.front-user')
@section('title',($title ?? ''))
@section("content")

<!-- Content Header (Page header) -->
<section class="content-header share-allert">
    <div class="title">
        <h2>{{$title}}</h2>
    </div>
    <div class="share-allert-text">
        <p>Share documents: Add recipients, set permissions and attach a personal message. We’ll send them an invitation to the shared workspace. You’ll be able to see all changes that are made.</p>
    </div>
</section>

<!-- Main content -->
<section class="content">
    {{ Form::open(['route' => ['front.send-for-review-save',$document->encrypted_id],'method'=>'post','id'=>'send-for-review-form','enctype'=>"multipart/form-data" ,'autocomplete' => 'off']) }}
    <div class="advance-settings-part">
        <h3>
            <a class="" data-toggle="collapse" href="#you-are-sharing" aria-expanded="true" aria-controls="you-are-sharing">
                <img class="icon" src="{{ asset('public/front/images/file-document-outline.svg') }}"> You Are Sharing <span><img src="{{ asset('/public/front/images/info-i.svg') }}"></span></a>
        </h3>
        <div class="collapse show" id="you-are-sharing">
            <div class="advance-settings-content">
                <div class="row">
                    <div class="col-lg-10 col-md-8">
                        <div class="single-document single-doc-signed">
                            <div class="doc-dots">
                                <button><i class="fas fa-bars"></i></button>
                            </div>
                            <div class="doc-img"><img src="{{ asset('public/front/images/doc-img-1.png') }}" class="user-image" alt="PDFWriter Admin Image">
                            </div>
                            <div class="doc-content">
                                <h5>{{ $document->name }}</h5>
                                <div class=" last-activity">Last update: {{ changeDateTimeFormat($document->updated_at) }}
                                </div>
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
        </div>
        <h3>
            <a class="" data-toggle="collapse" href="#recipients" aria-expanded="true" aria-controls="recipients">
                <img class="icon" src="{{ asset('public/front/images/add-user.svg') }}"> Recipients <span><img src="{{ asset('public/front/images/info-i.svg') }}"></span></a>
        </h3>
        <div class="collapse show" id="recipients">
            <div class="advance-settings-content">
                <div class="share-by" id="tabs">
                    <ul class="nav nav-tabs">
                        <li>
                            <a class="active" href="#email-link" id="switch-to-email">Share by Email</a>
                        </li>
                        <li>
                            <a href="#public-link" id="switch-to-link">Share by Public Link</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="email-link" class="tab-pane fade in active show">
                            <form>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="recipient_email" placeholder="Enter email" autocomplete="autocomplete">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="recipient_name" placeholder="Enter Name" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul>
                                            <li>
                                                <a class="add-recept-btn disabled" id="add-recipient" href="">Add recipient</a>
                                            </li>
                                            <!-- <li><a class="address-book-btn" href=""><i class="fas fa-address-book"></i> Address Book</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="public-link" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="document_operation">Anyone Can</label>
                                        <select name="document_operation" id="document_operation" class="form-control">
                                            @foreach($document_operations as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="public_link">Public Link</label>
                                        <input type="text" name="public_link" class="form-control" id="public_link" value="" placeholder="https://example.com">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <br>
                                        <a class="btn btn-success mt-3" data-clipboard-demo="" data-clipboard-target="#public_link" onclick="return false;" href="">
                                            <i class="far fa-copy"></i> Copy Link
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="email-link-elements recipient-block">

                </div>
            </div>
        </div>
        <h3 class="">
            <a class="" data-toggle="collapse" href="#authenticate-recipient" aria-expanded="true" aria-controls="authenticate-recipient">
                <img class="icon" src="{{ asset('public/front/images/authenticate-recipient.svg') }}"> Authenticate Recipient <span><img src="{{ asset('public/front/images/info-i.svg') }}"></span>
            </a>
        </h3>
        <div class="collapse show" id="authenticate-recipient">
            <div class="advance-settings-content">
                <div class="authentication-method">
                    <div class="authentication-method-title">
                        <h6>Authentication Method</h6>
                    </div>
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
        </div>


        <h3 class="email-link-elements">
            <a class="" data-toggle="collapse" href="#personalize_your_invitation" aria-expanded="true" aria-controls="personalize_your_invitation">
                <img class="icon" src="{{ asset('public/front/images/user-card.svg') }}"> Personalize Your Invitation <span><img src="{{ asset('public/front/images/info-i.svg') }}"></span>
            </a>
        </h3>
        <div class="collapse email-link-elements show" id="personalize_your_invitation">
            <div class="advance-settings-content">
                <div class="authentication-method">
                    <div class="personalize-invitation-part">
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Your Logo</h6>
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="personalize-invitation-content">
                                    <p>Replace the default PDF Writer logo with your own (optional).</p>
                                    <ul class="template-types logo-type">
                                        <li class="p-0">
                                            <div id="UploadLogo">
                                                <upload-gambar></upload-gambar>
                                            </div>
                                        </li>
                                        <li class="active">
                                            <img src="{{ asset('public/front/images/logo-blue.png') }}">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Select Template</h6>
                                </div>
                            </div>
                            <div class="col-md-9 col-lg-10">
                                <div class="personalize-invitation-content">
                                    <ul class="template-types">
                                        @foreach($invitation_templates as $template_id => $template_data)
                                        <li data-id="{{ $template_id }}" class="invitation_template_button {{$template_id==$default_invitation_template ? 'active' : ''}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14.21" height="14.21" viewBox="0 0 14.21 14.21">
                                                <path d="M11.672,34.03H10.15V32.761A.761.761,0,0,0,9.389,32H.761A.761.761,0,0,0,0,32.761V45.449a.761.761,0,0,0,.761.761H9.389a.761.761,0,0,0,.761-.761V44.113l2.557-1.141a2.54,2.54,0,0,0,1.5-2.317V36.567A2.54,2.54,0,0,0,11.672,34.03Zm.507,6.625a.508.508,0,0,1-.3.463l-1.729.772V36.06h1.522a.508.508,0,0,1,.507.507ZM6.6,43.165a.508.508,0,0,1-.507-.508v-7.1a.507.507,0,0,1,1.015,0v7.1A.508.508,0,0,1,6.6,43.165Zm-3.045,0a.508.508,0,0,1-.507-.508v-7.1a.507.507,0,0,1,1.015,0v7.1A.508.508,0,0,1,3.552,43.165Z" transform="translate(0 -32)" /></svg>
                                            <span>{{ $template_data['name'] }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Subject</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">
                                    <input name="personalize_invitation_data[subject]" id="personalize_invitation_data_subject" type="text" class="form-control" placeholder="Enter your Subject">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Message</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">
                                    <textarea rows="5" name="personalize_invitation_data[message]" id="personalize_invitation_data_message" class="form-control" placeholder="Enter your Message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="personalize-invitation-title">
                                    <h6>Your Business Card</h6>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="avatar-upload">
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url({{ asset('public/front/images/avatar.svg') }});">
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        {{ Form::file('business_card_image', ['id' => 'imageUpload','accept'=>".png, .jpg, .jpeg"]) }}
                                        <label for="imageUpload">Add Picture</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
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
            </div>
        </div>

        <h3 class="email-link-elements">
            <a class="" data-toggle="collapse" href="#reminders-for-recipients" aria-expanded="true" aria-controls="reminders-for-recipients">
                <img class="icon" src="{{ asset('public/front/images/bell.svg') }}"> Reminders for Recipients <span><img src="{{ asset('public/front/images/info-i.svg') }}"></span>
            </a>
        </h3>
        <div class="collapse email-link-elements show" id="reminders-for-recipients">
            <div class="advance-settings-content">
                <div class="authentication-method pb-0">
                    <div class="personalize-invitation-part">
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Automatic Reminder</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">
                                    {!! Form::select('reminder_duration', $automatic_reminder_duration_arr,null, array('class' => 'my-dropdown')) !!}
                                    <!-- <span class="reminder-text">If your shared documents haven't been opened by 12/12/2020.</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="personalize-invitation-title">
                                    <h6>Repeat the Reminder</h6>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <div class="personalize-invitation-content">
                                    {!! Form::select('reminder_repeat', $repeat_reminder_duration_arr,null, array('class' => 'my-dropdown')) !!}
                                    <!-- <span class="reminder-text">If the documents haven't been opened by 12/13/2020.</span> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="advance-settings-btns">
            {!! Form::submit('Share',['class'=>'share-btn','id'=>'share_btn','disabled'=>true]) !!}
            <a href="{{route('front.document-list')}}" class="my-doc-btn">My Docs</a>
        </div>

    </div>
    {{ Form::close() }}
</section>
<!-- /.content -->
<div class="modal fade more-options" id="public-link-enable-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Share with Public Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Using the sharing feature is pretty convenient and gives you more freedom and control on how many recipients should receive the shared documents. PDFWriter allows you to use two different Sharing Modes.
                </p>
                <div class="form-group">
                    <label for="name">Anyone can</label>
                    <select name="anyone_can" id="anyone_can" class="form-control">
                        @foreach($document_operations as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="share-link-btns">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" id="generate-link">Enable Link</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
@section('additionaljs')
<script src="{{ asset('public/front/js/vue.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var template_arr = @json($invitation_templates);
        var default_template = "{{$default_invitation_template}}";
        setTemplate(default_template);
        $(document).on('click', '#switch-to-link', function(e) {
            e.preventDefault();
            $('#public-link-enable-model').modal('show');
        });
        $(document).on('click', '#switch-to-email', function(e) {
            e.preventDefault();
            $('#public_link').val('');
            $('#document_operation').val('');
            $('.recipient-block').html('');
            $('.email-link-elements').removeClass('d-none');
            $('#share_btn').attr('disabled', true);
            $('#tabs a[href="#email-link"]').tab('show')
        });

        $(document).on('click', '#generate-link', function(e) {
            e.preventDefault();
            blockUI();
            var document_operation = $('#anyone_can').val();
            $.ajax({
                url: "{{route('front.send-for-review-generate-link')}}",
                type: "get",
                dataType: 'json',
                success: function(response) {
                    $('#public_link').val(response.data);
                    $('#document_operation').val(document_operation);
                    $('#tabs a[href="#public-link"]').tab('show');
                    $('#share_btn').attr('disabled', false);
                    $('.email-link-elements').addClass('d-none');
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                },
                complete: function() {
                    $('#public-link-enable-model').modal('hide');
                    unblockUI();
                },
            });
        })

        $(document).on('keyup', '#recipient_email', function(e) {
            if (isEmail($(this).val())) {
                $('#add-recipient').removeClass("disabled");
            } else {
                $('#add-recipient').addClass("disabled");
            }
        })

        $(document).on('click', '#add-recipient', function(e) {
            e.preventDefault();
            blockUI();
            var email = $('#recipient_email').val();
            var name = $('#recipient_name').val();
            $.ajax({
                url: "{{route('front.send-for-review-add-recipient')}}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": csrf_token,
                    email: email,
                    name: name
                },
                success: function(response) {
                    $('.recipient-block').append(response.html);
                    $('#recipient_email').val("");
                    $('#recipient_name').val("");
                    $('#add-recipient').addClass("disabled");
                    $('#share_btn').attr('disabled', false);
                },
                error: function(data) {
                    var response = data.responseJSON;
                    toastr.error(response.message);
                },
                complete: function() {
                    unblockUI();
                },
            });
        })

        $(document).on('click', '.remove-recipient', function(e) {
            e.preventDefault();
            $(this).closest('.recipients-user-info').remove();
            if ($('.recipients-user-info').length == 0) {
                $('#share_btn').attr('disabled', true);
            }
        })

        $(document).on('click', '.invitation_template_button', function(e) {
            e.preventDefault();
            setTemplate($(this).attr('data-id'));
        });

        function setTemplate(template_id) {
            var selected_template = template_arr[template_id];
            $('#personalize_invitation_data_subject').val(selected_template.subject);
            $('#personalize_invitation_data_message').html(selected_template.message);
        }

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
                        console.log(this);
                    }
                }
            }
        });
        new Vue({
            el: '#UploadLogo'
        })

    });
</script>
@endsection