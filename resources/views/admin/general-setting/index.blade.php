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
				@if(isset($general_setting))
				{!! Form::model($general_setting,['route' => ['general-setting.update'],'id'=>'general_setting_form','class'=>'form-horizontal','method' => 'put','enctype'=>"multipart/form-data"]) !!}
				@endif
				{!! Form::token() !!}
				<div class="col-xs-12 col-lg-6 col-md-9">
					<div class="form-group {{ $errors->has('site_title') ? ' has-error' : '' }}">
						<label for="site_title" class="control-label text-left col-sm-4 required">Site Title<span class="required-label">*</span></label>
						<div class="col-sm-8">
							{{ Form::text('site_title',old('site_title'),array('placeholder'=>'Enter Site Title','class'=>"form-control"))}}
							@if ($errors->has('site_title'))
							<span class="help-block"><strong>{{ $errors->first('site_title') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('currency') ? ' has-error' : '' }}">
						<label for="currency" class="control-label text-left col-sm-4 required">Currency<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::select('currency', $currency_arr, old('currency'),['class'=>'form-control']) }}
							@if ($errors->has('currency'))
							<span class="help-block"><strong>{{ $errors->first('currency') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('date_format') ? ' has-error' : '' }}">
						<label for="date_format" class="control-label text-left col-sm-4 required">Date Format<span class="required-label">*</span></label>
						<div class="col-sm-8">
							{{ Form::select('date_format', $date_format_arr, old('date_format'),['class'=>'form-control']) }}
							@if ($errors->has('date_format'))
							<span class="help-block"><strong>{{ $errors->first('date_format') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('time_format') ? ' has-error' : '' }}">
						<label for="time_format" class="control-label text-left col-sm-4 required">Time Format<span class="required-label">*</span></label>
						<div class="col-sm-8">
							{{ Form::select('time_format', $time_format_arr, old('time_format'),['class'=>'form-control']) }}
							@if ($errors->has('time_format'))
							<span class="help-block"><strong>{{ $errors->first('time_format') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('paging_limit') ? ' has-error' : '' }}">
						<label for="paging_limit" class="control-label text-left col-sm-4 required">Paging Limit<span class="required-label">*</span></label>
						<div class="col-sm-8">
							{{ Form::select('paging_limit', $paging_limit_arr, old('paging_limit'),['class'=>'form-control']) }}
							@if ($errors->has('paging_limit'))
							<span class="help-block"><strong>{{ $errors->first('paging_limit') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('facebook_url') ? ' has-error' : '' }}">
						<label for="facebook_url" class="control-label text-left col-sm-4 required">Facebook Url</label>
						<div class="col-sm-8">
							{{ Form::text('facebook_url',old('facebook_url'),array('placeholder'=>'Enter Facebook Url','class'=>"form-control"))}}
							@if ($errors->has('facebook_url'))
							<span class="help-block"><strong>{{ $errors->first('facebook_url') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('twitter') ? ' has-error' : '' }}">
						<label for="twitter" class="control-label text-left col-sm-4 required">Twitter Url</label>
						<div class="col-sm-8">
							{{ Form::text('twitter',old('twitter'),array('placeholder'=>'Enter Twitter Url','class'=>"form-control"))}}
							@if ($errors->has('twitter'))
							<span class="help-block"><strong>{{ $errors->first('twitter') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('instagram_url') ? ' has-error' : '' }}">
						<label for="instagram_url" class="control-label text-left col-sm-4 required">Instagram Url</label>
						<div class="col-sm-8">
							{{ Form::text('instagram_url',old('instagram_url'),array('placeholder'=>'Enter Instagram Url','class'=>"form-control"))}}
							@if ($errors->has('instagram_url'))
							<span class="help-block"><strong>{{ $errors->first('instagram_url') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('linked_in_url') ? ' has-error' : '' }}">
						<label for="linked_in_url" class="control-label text-left col-sm-4 required">LinkedIn Url</label>
						<div class="col-sm-8">
							{{ Form::text('linked_in_url',old('linked_in_url'),array('placeholder'=>'Enter LinkedIn Url','class'=>"form-control"))}}
							@if ($errors->has('linked_in_url'))
							<span class="help-block"><strong>{{ $errors->first('linked_in_url') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('ios_app_url') ? ' has-error' : '' }}">
						<label for="ios_app_url" class="control-label text-left col-sm-4 required">Ios App Url</label>
						<div class="col-sm-8">
							{{ Form::text('ios_app_url',old('ios_app_url'),array('placeholder'=>'Enter Ios App Url','class'=>"form-control"))}}
							@if ($errors->has('ios_app_url'))
							<span class="help-block"><strong>{{ $errors->first('ios_app_url') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('android_app_url') ? ' has-error' : '' }}">
						<label for="android_app_url" class="control-label text-left col-sm-4 required">Android App Url</label>
						<div class="col-sm-8">
							{{ Form::text('android_app_url',old('android_app_url'),array('placeholder'=>'Enter Android App Url','class'=>"form-control"))}}
							@if ($errors->has('android_app_url'))
							<span class="help-block"><strong>{{ $errors->first('android_app_url') }}</strong></span>
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							{!! Form::submit((isset($general_setting)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
							{!! Html::link(route('dashboard'),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\GeneralSettingsFormRequest') !!}
@endsection