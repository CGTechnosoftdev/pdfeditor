@extends('layouts.front-home')

@section('content')

<!-- Modal -->

<div class="account-popup modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
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
                                        <h3>Email Verification </h3>
                                        <p>Please enter the following details</p>
                                    </div>
                                    <div class="row">


                                        {{ Form::open(['route' => 'front.resend.verification.account.submit','method'=>'post','class'=>'','id' => 're_send_verification_form_id','enctype'=>"multipart/form-data"]) }}
                                        {{ Form::hidden("_token", csrf_token())}}

                                        <div class="col-md-12 input-group mb-3">
                                            {{ Form::text('email',null,array('placeholder'=>'Email address','class'=>"form-control email",'id' => "email-address"))}}
                                            <span class="required-value text-danger" id="email-error"></span>
                                        </div>


                                        <div class="col-sm-6">
                                            <a href="#" class="w-100 btn btn-secondary" id="resend_verificationemailId">Submit</a>

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
            <!-- <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		 <span id="ButtonContainerId"></span>
		
      </div> -->
        </div>
    </div>
</div>

@endsection
@section('additionaljs')
<script type="text/javascript">
    $('#exampleModal').modal();

    jQuery("document").ready(function($) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        $('#resend_verificationemailId').click(function() {


            $('#email-error').text("");
            $('#password-error').text("");

            $("#success_msg_id_container").removeClass("visible");
            $("#success_msg_id_container").addClass("invisible");

            $('#email-error').text("")
            $.ajax({
                type: "POST",
                url: "{{ route('front.resend.verification.account.submit') }}",
                /* data: { email:$("#newemail").val(), password:$("#newpass").val(), _token:$("#newtoken").val() }, */
                data: $('#re_send_verification_form_id').serialize(),

                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        //  alert(msg.success);
                        $("#success_msg_id").html(response.success);
                        $("#success_msg_id_container").removeClass("invisible");
                        $("#success_msg_id_container").addClass("visible");
                    }
                },
                error: function(response) {
                    console.log(response);
                    $('#email-error').text(response.responseJSON.errors.email);
                    $("#error_msg_id").html(response.message);
                    $("#error_msg_id_container").removeClass("invisible");
                    $("#error_msg_id_container").addClass("visible");



                }
            });



            //$("#forgotpasswordid").trigger("click");

        });



        //$("#forgotpasswordid").trigger("click");

    });
</script>
@endsection