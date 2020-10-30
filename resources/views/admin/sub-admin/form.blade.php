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
				<div class="col-xs-12 col-lg-6 col-md-9">
					@if(isset($sub_admin))
					{{ Form::model($sub_admin,['route' => ['sub-admin.update',$sub_admin->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'sub-admin.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}

					<div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
						<label for="first_name" class="control-label text-left col-sm-4 required">First Name<span class="required-label">*</span> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="your text here"></i></label>	
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
					<div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
						<label for="role_id" class="control-label text-left col-sm-4 required">Role<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{!! Form::select('role_id',[''=>"Select"] + $role_arr, old('role_id'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							@if ($errors->has('role_id'))
							<span class="help-block"><strong>{{ $errors->first('role_id') }}</strong></span>
							@endif		
						</div>						
					</div>
					<div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
						<label for="gender" class="control-label text-left col-sm-4 required">Gender<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							<!-- {!! Form::select('gender',[''=>"Select Gender"] + $gender_arr, old('gender'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							@if ($errors->has('gender'))
							<span class="help-block"><strong>{{ $errors->first('gender') }}</strong></span>
							@endif -->
							<div class="my-radio">
								<input type="radio" id="radio03-01" name="demo03" /><label for="radio03-01">Male</label>
							</div>
							<div class="my-radio">
								<input type="radio" id="radio03-02" name="demo03" /><label for="radio03-02">Female</label>
							</div>
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
					<div class="form-group {{ $errors->has('country_id') || $errors->has('contact_number') ? ' has-error' : '' }}">
						<label for="contact_number" class="control-label text-left col-sm-4 required">Contact Number</label>
						<div class="col-sm-4">
							{!! Form::select('country_id', [''=>"Select Code"] + $country_arr, old('country_id'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							@if ($errors->has('country_id'))
							<span class="help-block"><strong>{{ $errors->first('country_id') }}</strong></span>
							@endif
						</div>
						<div class="col-sm-4">
							{{ Form::text('contact_number',null,array('placeholder'=>'Enter Contact Number','class'=>"form-control"))}}
							@if ($errors->has('contact_number'))
							<span class="help-block"><strong>{{ $errors->first('contact_number') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="control-label text-left col-sm-4 required">Password</label>
						<div class="col-sm-8" >
							{{ Form::password('password', ['class' => 'form-control','placeholder' => 'Enter Password ','id'=>'password' ]) }}   
							@if ($errors->has('password'))
							<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
						<label for="confirm_password" class="control-label text-left col-sm-4 required">Confirm Password</label>
						<div class="col-sm-8" >
							{{ Form::password('confirm_password', ['class' => 'form-control','placeholder' => 'Enter Confirm Password ','id'=>'confirm_password' ]) }} 
							@if ($errors->has('confirm_password'))
							<span class="help-block"><strong>{{ $errors->first('confirm_password') }}</strong></span>
							@endif
						</div>
					</div>
					<!-- <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
						<label for="profile_picture" class="control-label text-left col-sm-4 required">Profile Picture</label>
						<div class="col-sm-8" >
							{{ Form::file('profile_picture', ['class' => 'form-control','placeholder' => 'Enter Confirm Password ','id'=>'profile_picture' ]) }} 
							@if ($errors->has('profile_picture'))
							<span class="help-block"><strong>{{ $errors->first('profile_picture') }}</strong></span>
							@endif
						</div>
					</div> -->
					<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
						<label for="status" class="control-label text-left col-sm-4 required">Status</label>
						<div class="col-sm-8" >
							{!! Form::select('status',[''=>"Select Status"] + $status_arr, old('status'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							@if ($errors->has('status'))
							<span class="help-block"><strong>{{ $errors->first('status') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							{!! Form::submit((isset($sub_admin)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
							{!! Html::link(route('sub-admin.index'),'Cancel',['class'=>'btn btn-default']) !!}
						</div>
					</div>
					{{ Form::close() }}

				</div>
				@if(isset($sub_admin))
				<div class="col-xs-4 col-md-4">			
					<img src='{{$sub_admin->profile_picture_url}}' width="50px" />
					@if(!empty($sub_admin->profile_picture))
					<!-- <br><br> 
					<a href='{{route("delete-profile-picture")}}' onclick="return confirm('Are you sure you want to delete?')">Delete Image</a> -->
					@endif 
				</div>
				@endif
				<!-- /.row -->
				<div class="col-xs-12 col-lg-6 col-md-3">			
					<div class="upload-img">
						<div class="img-preview">
						<img id="blah" src="{{ asset('public/admin/dist/img/camera-account.svg') }}" alt="your image" />
						</div>	
						<div class="upload-img-btn">
							<span>Profile Picture</span>
						<input type='file' onchange="readURL(this);" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
<!-- /.content -->

@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\SubAdminFormRequest') !!}
@endsection