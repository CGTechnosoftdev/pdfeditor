@extends('layouts.admin-login')

@section('content')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
    <div class="login-logo">
        <a href="#"><b>{{ config('app.name') }}</b></a>
    </div>
        <p class="login-box-msg">Forgot Pasword</p>
        <div class="alert alert-success alert-block invisible" id="success_msg_id_container"> 			
 			<strong id="success_msg_id"></strong>
 			<button type="button" class="close" data-dismiss="alert">×</button>
 		</div>
        <form method="POST" action="{{ route('front.resetpassword.save') }}" id="resetPasswordFrm">
         
         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label for="email" class="col-form-label">{{ __('E-Mail') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email"  value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                  
                        <span class="invalid-feedback" role="alert">
                            <strong id="email-error"></strong>
                        </span>
                       
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }} <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ config('constant.PASSWORD_REGEX_INSTRUCTION') }}"></i></label>
                        <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                       
                        <span class="invalid-feedback" role="alert">
                            <strong id="password-error"></strong>
                        </span>
                   
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-success  btn-block btn-flat" id="resetpasswordId" href="#">Reset Password</a>
                </div>
                <!-- /.col -->
            </div>
        </form>
        
    </div> 
    <!-- /.login-box-body -->
</div>

</div>
      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		 <span id="ButtonContainerId"></span>
		
      </div>
    </div>
  </div>
</div>

@endsection
@section('additionaljs')
<script type="text/javascript">
   $('#exampleModal').modal();

   $('body').on("click","#resetpasswordId",function(){
       //resetPasswordFrm
       $('#email-error').text("");
              $('#password-error').text("");

			  $("#success_msg_id_container").removeClass("visible");
			$("#success_msg_id_container").addClass("invisible");

       $.ajax({
        type: "POST",
        url: "{{ route('front.resetpassword.save') }}",
       
	   data: $('#resetPasswordFrm').serialize(),
        success: function( msg ) {
          window.location.href=msg;
        },
		error: function(response) {
              
              $('#email-error').text(response.responseJSON.errors.email);
              $('#password-error').text(response.responseJSON.errors.password);
              
          }
    });
    


   });
</script>
@endsection