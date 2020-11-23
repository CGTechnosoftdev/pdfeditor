@extends('layouts.front-home')
@section('content')
<!-- Modal -->
<div class="account-popup modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="login-popup login-form ">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="alert alert-success alert-block invisible" id="success_msg_id_container">
                                <strong id="success_msg_id"></strong>
                                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
                            <div class="d-table ">
                                <div class="d-table-cell align-middle">
                                    <div class="heading">
                                        <h3>Reset Password</h3>
                                        <p>Please enter the following details</p>
                                    </div>
                                    <div class="row">
                                        {{ Form::open(['route' => 'front.resetpassword.save','method'=>'post','class'=>'','id' => 'resetPasswordFrm','enctype'=>"multipart/form-data"]) }}
                                        {{ Form::hidden("_token", csrf_token())}}
                                        {{ Form::hidden("token", $token)}}
                                        <div class="input-group mb-3">
                                            <div class="col-md-12">
                                                {{ Form::text('email',$email,array('placeholder'=>'Email address','class'=>"form-control email",'id' => "email-address"))}}<br>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="required-value text-danger" id="email-error"></span>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="col-md-12">
                                                {{ Form::password('password', ['class' => 'form-control password','placeholder' => 'Password','id'=>'password' ]) }}
                                            </div>
                                            <div class="col-md-12">
                                                <span class="help-block text-danger" id="password-error"></span>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="col-md-12">
                                                {{ Form::password('password_confirmation', ['class' => 'form-control password','placeholder' => 'Confirm Password','id'=>'password' ]) }}
                                            </div>
                                        </div>
                                        <div class="col-md-12  input-group">
                                            <span class="required-value"><i class="fas fa-lock"></i> {{ config('constant.PASSWORD_REGEX_INSTRUCTION') }}</span>
                                        </div>
                                        <br>
                                        <div class="col-sm-6 input-group">
                                            <a href="#" id="resetpasswordId" class="w-100 btn btn-outline-secondary">Login</a>
                                        </div>

                                        {{ Form::close() }}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 pl-md-4">
                            <div class="account-img">
                                <img src="{{ asset('public/front/images/login-bg.png')}}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('additionaljs')
<script type="text/javascript">
    $('#exampleModal').modal();

    $('body').on("click", "#resetpasswordId", function() {
        //resetPasswordFrm
        $('#email-error').text("");
        $('#password-error').text("");

        $("#success_msg_id_container").removeClass("visible");
        $("#success_msg_id_container").addClass("invisible");

        $.ajax({
            type: "POST",
            url: "{{ route('front.resetpassword.save') }}",
            data: $('#resetPasswordFrm').serialize(),
            success: function(msg) {
                window.location.href = msg;
            },
            error: function(response) {
                var errors = response.responseJSON.errors;
                if (errors.email) {
                    $('#email-error').text(response.responseJSON.errors.email[0]);
                }
                if (errors.password) {
                    $('#password-error').text(response.responseJSON.errors.password[0]);
                }
            }
        });
    });
</script>
@endsection