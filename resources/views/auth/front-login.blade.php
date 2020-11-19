@extends('layouts.admin-login')

@section('content')
<div class="login-box">
	<!-- /.login-logo -->
	<div class="login-box-body">
		<div class="login-logo">
			<a href="#"><b>{{ config('app.name') }}</b></a>
		</div>
		<p class="login-box-msg">Front Sign In</p>
		@include('admin.partials.flash-messages')
		<form method="POST" action="{{ route('front.login') }}">
			@csrf
			<div class="row">
				<div class="col-md-12">
					<div class="form-group has-feedback">
						<label for="email" class="col-form-label">{{ __('Email Address') }}</label>
						<input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group has-feedback">
						<label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
						<input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="col-md-12">
					<div class="checkbox">
						<input class="styled-checkbox" id="remember-me" type="checkbox" value="1">
						<label for="remember-me">Remember Me</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-md-4">
					<button type="submit" class="btn btn-success  btn-block btn-flat">{{ __('Login') }}</button>
					<br/>
					<form>
						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<a href="{{ url('/login/facebook') }}" class="btn btn-facebook"> Facebook</a>
								
							</div>
						</div>
					</form>
					<a href="{{ url('/login/google') }}" class="btn btn-google"> Google</a>
				</div>
				<div class="col-md-8 text-right">
					<a class="btn btn-link" href="#" id="forgotpasswordid" data-path="{{ route('front.forgot.password') }}"> 
						{{ __('Forgot Password?') }}
					</a>
					
					<a class="btn btn-link load-ajax-modal" href="#"  data-path="{{ route('front.user.registration') }}"   role="button"  data-target="#exampleModal">
						{{ __('New User') }}
					</a>                    					

				</div>
				<!-- /.col -->
			</div>
		</form>
		
	</div> 
	<!-- /.login-box-body -->
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">User Registration</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
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
<script>
	jQuery("document").ready(function($){

		$.ajaxSetup({
			headers: {
				'X-CSRF-Token': $('meta[name="_token"]').attr('content')
			}
		});

		$('body').on("click","#reverificationemailId",function(){


			$("#exampleModalLabel").text("Email Verification");
			$("#ButtonContainerId").html('<a href="#" class="btn btn-success" id="emailverificationid">Submit</a>');
			$.ajax({
				type : 'GET',
				url : $(this).data('path'),

				success: function(result) {
					$('#exampleModal div.modal-body').html(result);

					$('#exampleModal').modal()

					$("#emailverificationid").click(function(){

						$('#email-error').text("");
						$('#password-error').text("");

						$("#success_msg_id_container").removeClass("visible");
						$("#success_msg_id_container").addClass("invisible");

						$.ajax({
							type: "POST",
							url: "{{ route('front.reverification.account.submit') }}",
							/* data: { email:$("#newemail").val(), password:$("#newpass").val(), _token:$("#newtoken").val() }, */
							data: $('#reverificationfrm_id').serialize(),
							success: function( msg ) {
								if(msg.success){
			//  alert(msg.success);
			$("#success_msg_id").html(msg.success);
			$("#success_msg_id_container").removeClass("invisible");
			$("#success_msg_id_container").addClass("visible");
		}
	},
	error: function(response) {
		
		$('#email-error').text(response.responseJSON.errors.email);
		$('#password-error').text(response.responseJSON.errors.password);
		
	}
});

//	alert("submit the form!");
});
				}
			});



	//$("#forgotpasswordid").trigger("click");

});


		$('body').on("click",".load-ajax-modal",function(){


			$("#exampleModalLabel").text("User Registration");
			$("#ButtonContainerId").html('<a href="#" class="btn btn-success" id="newregisterid">Submit</a>');
			$.ajax({
				type : 'GET',
				url : $(this).data('path'),

				success: function(result) {
					$('#exampleModal div.modal-body').html(result);

					$('#exampleModal').modal()

					$("#newregisterid").click(function(){

						$('#email-error').text("");
						$('#password-error').text("");

						$("#success_msg_id_container").removeClass("visible");
						$("#success_msg_id_container").addClass("invisible");

						$.ajax({
							type: "POST",
							url: "{{ route('front.user.registration.save') }}",
							/* data: { email:$("#newemail").val(), password:$("#newpass").val(), _token:$("#newtoken").val() }, */
							data: $('#user_registration_id').serialize(),
							success: function( msg ) {
								if(msg.success){
			//  alert(msg.success);
			$("#success_msg_id").html(msg.success);
			$("#success_msg_id_container").removeClass("invisible");
			$("#success_msg_id_container").addClass("visible");
		}
	},
	error: function(response) {
		
		$('#email-error').text(response.responseJSON.errors.email);
		$('#password-error').text(response.responseJSON.errors.password);
		
	}
});

//	alert("submit the form!");
});
				}
			});


		});

		$("body").on("click","#forgotpasswordid",function(){
			$("#exampleModalLabel").text("Forgot Password");
			$("#ButtonContainerId").html('<a href="#" class="btn btn-success" id="forgot_password_submit_id">Submit</a>');
			$.ajax({
				type : 'GET',
				url : $(this).data('path'),

				success: function(result) {
					$('#exampleModal div.modal-body').html(result);

					$('#exampleModal').modal()

					$("#forgot_password_submit_id").click(function(){

						$('#email-error').text("");
						
						$("#success_msg_id_container").removeClass("visible");
						$("#success_msg_id_container").addClass("invisible");

						$.ajax({
							type: "POST",
							url: "{{ route('front.resetpassword.email') }}",
							/* data: { email:$("#newemail").val(), password:$("#newpass").val(), _token:$("#newtoken").val() }, */
							data: $('#forgotpasswordfrm_id').serialize(),
							success: function( msg ) {
								if(msg.status){
						//  alert(msg.success);
						$("#success_msg_id").html(msg.success);
						$("#success_msg_id_container").removeClass("invisible");
						$("#success_msg_id_container").addClass("visible");
					}
					else{
						$('#email-error-txt').text(msg.error);
					}
					
					
				},
				error: function(response) {
					
					$('#email-error-txt').text(response.responseJSON.errors.email);
					
					
				}
			});


//	alert("submit the form!");
});
				}
			});

			

		});



		
	});
</script>

@endsection
