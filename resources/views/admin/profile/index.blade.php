@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change-password-modal">
				Change Password
			</button>	
		</div>
		<div class="col-xs-8 col-md-8">
			@if(isset($user))
			{!! Form::model($user,['route' => ['update-profile'],'id'=>'profile_form','class'=>'form-horizontal','method' => 'put','enctype'=>"multipart/form-data"]) !!}
			@endif
			{!! Form::token() !!}

			<div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
				<label for="first_name" class="control-label col-sm-4 required">First Name<span class="required-label">*</span></label>	
				<div class="col-sm-8">
					{{ Form::text('first_name',null,array('placeholder'=>'Enter First Name','class'=>"form-control"))}}
					@if ($errors->has('first_name'))
					<span class="help-block"><strong>{{ $errors->first('first_name') }}</strong></span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
				<label for="last_name" class="control-label col-sm-4 required">Last Name<span class="required-label">*</span></label>
				<div class="col-sm-8" >
					{{ Form::text('last_name',null,array('placeholder'=>'Enter Last Name','class'=>"form-control"))}}
					@if ($errors->has('last_name'))
					<span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
				<label for="gender" class="control-label col-sm-4 required">Gender<span class="required-label">*</span></label>
				<div class="col-sm-8" >
					{!! Form::select('gender',[''=>"Select Gender"] + $gender_arr, old('gender'), ['class'=>'form-control required','data-unit'=>'from']) !!}
					@if ($errors->has('gender'))
					<span class="help-block"><strong>{{ $errors->first('gender') }}</strong></span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email" class="control-label col-sm-4 required">Email<span class="required-label">*</span></label>
				<div class="col-sm-8" >
					{{ Form::text('email',null,array('placeholder'=>'Enter Email','class'=>"form-control"))}}
					@if ($errors->has('email'))
					<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('country_id') || $errors->has('contact_number') ? ' has-error' : '' }}">
				<label for="contact_number" class="control-label col-sm-4 required">Contact Number</label>
				<div class="col-md-4">
					{!! Form::select('country_id', [''=>"Select Code"] + $country_arr, old('country_id'), ['class'=>'form-control required','data-unit'=>'from']) !!}
					@if ($errors->has('country_id'))
					<span class="help-block"><strong>{{ $errors->first('country_id') }}</strong></span>
					@endif
				</div>
				<div class="col-md-4">
					{{ Form::text('contact_number',null,array('placeholder'=>'Enter Contact Number','class'=>"form-control"))}}
					@if ($errors->has('contact_number'))
					<span class="help-block"><strong>{{ $errors->first('contact_number') }}</strong></span>
					@endif
				</div>
			</div>
			<div class="form-group {{ $errors->has('profile_picture') ? ' has-error' : '' }}">
				<label for="profile_picture" class="control-label col-sm-4 required">Profile Picture</label>
				<div class="col-sm-8" >
					{{ Form::file('profile_picture', ['class' => 'form-control','placeholder' => 'Enter Confirm Password ','id'=>'profile_picture' ]) }} 
					@if ($errors->has('profile_picture'))
					<span class="help-block"><strong>{{ $errors->first('profile_picture') }}</strong></span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					{!! Form::submit((isset($user)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
					{!! Html::link(route('sub-admin.index'),'Cancel',['class'=>'btn btn-default']) !!}
				</div>
			</div>
			{{ Form::close() }}

		</div>
		@if(isset($user))
		<div class="col-xs-4 col-md-4">			
			<img src='{{$user->profile_picture_url}}' width="50px" />
			@if(!empty($user->profile_picture))
			<br><br> 
			<a href='{{route("delete-profile-picture")}}' onclick="return confirm('Are you sure you want to delete?')">Delete Image</a>
			@endif 
		</div>
		@endif
		<!-- /.row -->
	</div>

</section>
<!-- /.content -->

<div class="modal fade" id="change-password-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Change Password</h4>
				</div>
				{{ Form::open(['route' => 'update-password','method'=>'patch','id'=>'update_password_form']) }}
				@csrf  
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-lg-12 {{ $errors->has('current_password') ? ' has-error' : '' }}">
							{!! Form::label('current_password', "Current Password",['class'=>'form-control-label']) !!}
							<span class="required-label">*</span>
							{!! Form::password('current_password',['class'=>'form-control '.($errors->has("current_password") ? "is-invalid" : ""),'id'=>'current_password']) !!}
							<div class="{{ ($errors->has('current_password') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('current_password') }}
							</div>
						</div>
						<div class="form-group col-lg-12 {{ $errors->has('password') ? ' has-error' : '' }}">
							{!! Form::label('password', "Password",['class'=>'form-control-label']) !!}
							<span class="required-label">*</span>
							{!! Form::password('password',['class'=>'form-control '.($errors->has("password") ? "is-invalid" : ""),'id'=>'password']) !!}
							<div class="{{ ($errors->has('password') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('password') }}
							</div>
						</div>
						<div class="form-group col-lg-12 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
							{!! Form::label('password_confirmation', "Confirm Password",['class'=>'form-control-label']) !!}
							<span class="required-label">*</span>
							{!! Form::password('password_confirmation',['class'=>'form-control '.($errors->has("password_confirmation") ? "is-invalid" : ""),'id'=>'password_confirmation']) !!}
							<div class="{{ ($errors->has('password_confirmation') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('password_confirmation') }}
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					{!! Form::submit('Change Password',['class'=>'btn btn-success']) !!}
				</div>
				{{ Form::close() }}

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
@endsection
@section('additionaljs')
@if($errors->hasAny(['current_password','password','password_confirmation']))
<script type="text/javascript">
	$("#change-password-modal").modal();
</script>
@endif
{!! JsValidator::formRequest('App\Http\Requests\ProfileFormRequest','#profile_form') !!}
{!! JsValidator::formRequest('App\Http\Requests\ChangePasswordFormRequest','#update_password_form') !!}
@endsection