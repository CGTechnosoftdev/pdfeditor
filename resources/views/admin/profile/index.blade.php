@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('sub_heading',($sub_heading ?? ''))
@section('breadcrumb',$breadcrumb)
@section('content')  
<div class="box ">
	<div class="box-header with-border">
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change-password-modal">
			Change Password
		</button>	

		@if(isset($user))
		{!! Form::model($user,['route' => ['update-profile'],'id'=>'profile_form','method' => 'put','enctype'=>"multipart/form-data"]) !!}
		@endif
		{!! Form::token() !!}
		<!-- /.box-header -->
		<div class="box-body">
			<div class="row">
				<div class="form-group col-lg-6 {{ $errors->has('first_name') ? ' has-error' : '' }}">
					{!! Form::label('first_name', 'First Name',['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					{!! Form::text('first_name',old('first_name'),['class'=>'form-control  '.($errors->has("first_name") ? "is-invalid" : ""),'id'=>'first_name']) !!}
					<div class="{{ ($errors->has('first_name') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('first_name') }}
					</div>
				</div>
				<div class="form-group col-lg-6 {{ $errors->has('last_name') ? ' has-error' : '' }}">
					{!! Form::label('last_name', 'Last Name',['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					{!! Form::text('last_name',old('last_name'),['class'=>'form-control  '.($errors->has("last_name") ? "is-invalid" : ""),'id'=>'last_name']) !!}
					<div class="{{ ($errors->has('last_name') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('last_name') }}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-6 {{ $errors->has('email') ? ' has-error' : '' }}">
					{!! Form::label('email', "Email",['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					{!! Form::text('email',old('email'),['class'=>'form-control  '.($errors->has("email") ? "is-invalid" : ""),'id'=>'email','readonly']) !!}
					<div class="{{ ($errors->has('email') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('email') }}
					</div>
				</div>
				<div class="form-group col-lg-6 {{ ($errors->has('country_id') || $errors->has('contact_number')) ? ' has-error' : '' }}">
					{!! Form::label('contact_number', "Contact Number",['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					<div class="row">
						<div class="col-md-6">
							{!! Form::select('country_id',[''=>'Select Country Code'] + $country_arr, old('country_id'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							<div class="{{ ($errors->has('country_id') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('country_id') }}
							</div>
						</div> 
						<div class="col-md-6">
							{!! Form::text('contact_number',old('contact_number'),['class'=>'form-control  '.($errors->has("contact_number") ? "is-invalid" : ""),'id'=>'contact_number']) !!}
							<div class="{{ ($errors->has('contact_number') ? 'invalid-feedback' : '') }}">
								{{ $errors->first('contact_number') }}
							</div>
						</div> 

					</div>				
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-6  {{ $errors->has('gender') ? ' has-error' : '' }}">
					{!! Form::label('gender', "Gender", ['class'=>'form-control-label']) !!}
					<span class="required-label">*</span>
					{!! Form::select('gender',[''=>'Select'] + $gender_arr, old('gender'), ['class'=>'form-control required','data-unit'=>'from']) !!}
					<div class="{{ ($errors->has('gender') ? 'invalid-feedback' : '') }}">
						{{ $errors->first('gender') }}
					</div>
				</div>
				<div class=" form-group col-md-6">
					<label>Image</label>
					<div class="row">
						<div class="col-md-6"><input type="file" name="profile_picture" class="form-control" /></div>
						<div class="col-md-6">
							@if(!empty($user->profile_picture))
							<img src='{{$user->profile_picture}}' width="50px" />
							<br><br> 
							<a href='{{route("delete-profile-picture")}}' onclick="return confirm('Are you sure you want to delete?')">Delete Image</a>
							@endif 
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 ">
					{!! Form::submit('Update',['class'=>'btn btn-success']) !!}
				</div>
			</div>
		</div>
		<!-- /.box-body -->
		{{ Form::close() }}
	</div>
</div>
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

