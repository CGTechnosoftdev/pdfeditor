@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<section class="content">
	<!-- Info boxes -->
	<div class="box">
		<div class="box-body">
			<div class="row">
				@if(isset($user))
				{!! Form::model($user,['route' => ['update-profile'],'id'=>'profile_form','class'=>'form-horizontal','method' => 'put','enctype'=>"multipart/form-data"]) !!}
				@endif
				{!! Form::token() !!}
				<div class="col-xs-12 col-lg-6 col-md-9">
					<div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
						<label for="first_name" class="control-label text-left col-sm-4 required">First Name<span class="required-label">*</span></label>	
						<div class="col-sm-8">
							{{ Form::text('first_name',null,array('placeholder'=>'Enter First Name','class'=>"form-control"))}}
							@if ($errors->has('first_name'))
							<span class="help-block"><strong>{{ $errors->first('first_name') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
						<label for="last_name" class="control-label text-left col-sm-4 required">Last Name<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('last_name',null,array('placeholder'=>'Enter Last Name','class'=>"form-control"))}}
							@if ($errors->has('last_name'))
							<span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
						<label for="gender" class="control-label text-left col-sm-4 required">Gender<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							@foreach($gender_arr as $key => $gender)
							<div class="my-radio">
								{!! Form::radio('gender', $key, (old('gender') ==  $key), ['id'=>'gender-'.$key]) !!}
								<label for="{{'gender-'.$key}}">{{$gender}}</label>
							</div>
							@endforeach
							@if ($errors->has('gender'))
							<span class="help-block"><strong>{{ $errors->first('gender') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email" class="control-label text-left col-sm-4 required">Email<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('email',null,array('placeholder'=>'Enter Email','class'=>"form-control"))}}
							@if ($errors->has('email'))
							<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('contact_number') ? ' has-error' : '' }}">
						<label for="contact_number" class="control-label text-left col-sm-4 required">Contact Number</label>
						<div class="col-sm-8">
							{{ Form::text('contact_number',null,array('placeholder'=>'Enter Contact Number','class'=>"form-control"))}}
							@if ($errors->has('contact_number'))
							<span class="help-block"><strong>{{ $errors->first('contact_number') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('profile_picture') ? ' has-error' : '' }}">
						<div class="col-sm-offset-4 col-sm-8" >
							{{ Form::checkbox('change_password',1,old('change_password'),['id'=>'change-password-checkbox','class'=>'styled-checkbox']) }}
							<label for="change-password-checkbox">Change Password</label>
						</div>
					</div>

					<div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
						<label for="current_password" class="control-label text-left col-sm-4 required">Current Password</label>
						<div class="col-sm-8" >
							{!! Form::password('current_password',['class'=>'form-control change-password-elements '.($errors->has("current_password") ? "is-invalid" : ""),'id'=>'current_password','disabled'=>(empty(old('change_password')) ? true : false)]) !!}
							<div class="{{ ($errors->has('current_password') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('current_password') }}
							</div>
						</div>
					</div>
					<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="control-label text-left col-sm-4 required">Password</label>
						<div class="col-sm-8" >
							{!! Form::password('password',['class'=>'form-control change-password-elements '.($errors->has("password") ? "is-invalid" : ""),'id'=>'password','disabled'=>(empty(old('change_password')) ? true : false)]) !!}
							<div class="{{ ($errors->has('password') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('password') }}
							</div>
						</div>
					</div>
					<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
						<label for="password_confirmation" class="control-label text-left col-sm-4 required">Confirm Password</label>
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
					

				</div>
				<div class="col-xs-12 col-lg-6 col-md-3">			
					<div class="upload-img form-group {{ $errors->has('profile_picture') ? ' has-error' : '' }}">
						<div class="img-preview">
							<img id="blah" src="{{ (isset($user) && !empty($user->profile_picture) ? $user->profile_picture_url : asset('public/admin/dist/img/camera-account.svg')) }}" alt="your image" />
						</div>	
						<div class="upload-img-btn">
							<span>Profile Picture</span>
							{{ Form::file('profile_picture', ['onchange' => 'readURL(this);']) }} 
							@if ($errors->has('profile_picture'))
							<span class="help-block"><strong>{{ $errors->first('profile_picture') }}</strong></span>
							@endif
						</div>
					</div>
				</div>
				{{ Form::close() }}
				<!-- /.row -->
			</div>
		</div>
	</div>

</section>
<!-- /.content -->
@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\ProfileFormRequest','#profile_form') !!}
@endsection