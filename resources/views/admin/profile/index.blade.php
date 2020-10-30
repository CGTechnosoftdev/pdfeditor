@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<section class="content">
	<!-- Info boxes -->
	<div class="row">
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
			<div class="form-group {{ $errors->has('profile_picture') ? ' has-error' : '' }}">
				<div class="col-sm-offset-4 col-sm-8" >
					<label class="control-label">
						{{ Form::checkbox('change_password',1,old('change_password'),['id'=>'change-password-checkbox']) }} Change Password
					</label>
				</div>
			</div>

			<div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
				<label for="current_password" class="control-label col-sm-4 required">Current Password</label>
				<div class="col-sm-8" >
					{!! Form::password('current_password',['class'=>'form-control change-password-elements '.($errors->has("current_password") ? "is-invalid" : ""),'id'=>'current_password','disabled'=>(empty(old('change_password')) ? true : false)]) !!}
					<div class="{{ ($errors->has('current_password') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('current_password') }}
					</div>
				</div>
			</div>
			<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="password" class="control-label col-sm-4 required">Password</label>
				<div class="col-sm-8" >
					{!! Form::password('password',['class'=>'form-control change-password-elements '.($errors->has("password") ? "is-invalid" : ""),'id'=>'password','disabled'=>(empty(old('change_password')) ? true : false)]) !!}
					<div class="{{ ($errors->has('password') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('password') }}
					</div>
				</div>
			</div>
			<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
				<label for="password_confirmation" class="control-label col-sm-4 required">Confirm Password</label>
				<div class="col-sm-8" >
					{!! Form::password('password_confirmation',['class'=>'form-control change-password-elements '.($errors->has("password_confirmation") ? "is-invalid" : ""),'id'=>'password_confirmation','disabled'=>(empty(old('change_password')) ? true : false)]) !!}
					<div class="{{ ($errors->has('password_confirmation') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('password_confirmation') }}
					</div>
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
@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\ProfileFormRequest','#profile_form') !!}
@endsection