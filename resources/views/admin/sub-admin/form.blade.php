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
				@if(isset($sub_admin))
				{{ Form::model($sub_admin,['route' => ['sub-admin.update',$sub_admin->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"]) }}
				@else
				{{ Form::open(['route' => 'sub-admin.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
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
							@php $selected_gender = old('gender') ?? config('constant.DEFAULT_GENDER') @endphp
							@foreach($gender_arr as $key => $gender)
							<div class="my-radio">
								{!! Form::radio('gender', $key, ($selected_gender ==  $key), ['id'=>'gender-'.$key]) !!}
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
					<div class="form-group {{ $errors->has('country_id') || $errors->has('contact_number') ? ' has-error' : '' }}">
						<label for="contact_number" class="control-label text-left col-sm-4 required">Contact Number</label>
						<div class="col-sm-8">
							{{ Form::text('contact_number',null,array('placeholder'=>'Enter Contact Number','class'=>"form-control"))}}
							@if ($errors->has('contact_number'))
							<span class="help-block"><strong>{{ $errors->first('contact_number') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="control-label text-left col-sm-4 required">
							Password
							<i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ config('constant.PASSWORD_REGEX_INSTRUCTION') }}"></i>
						</label>
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
					<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
						<label for="status" class="control-label text-left col-sm-4 required">Status<span class="required-label">*</span></label>
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
				</div>
				<!-- /.row -->
				<div class="col-xs-12 col-lg-6 col-md-3">			
					<div class="upload-img form-group {{ $errors->has('profile_picture') ? ' has-error' : '' }}">
						<div class="img-preview">
							<img id="blah" src="{{ (isset($sub_admin) && !empty($sub_admin->profile_picture) ? $sub_admin->profile_picture_url : asset('public/admin/dist/img/camera-account.svg')) }}" alt="your image" />
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
			</div>
		</div>
	</div>
</section>
<!-- /.content -->

@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\SubAdminFormRequest') !!}
@endsection