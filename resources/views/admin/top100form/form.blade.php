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
				@if(isset($top100Form))
				{{ Form::model($top100Form,['route' => ['top-100-form.update',$top100Form->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"]) }}
				@else
				{{ Form::open(['route' => 'top-100-form.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
				@endif
				{!! Form::token() !!}

				<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="control-label text-left col-sm-4 required">Name<span class="required-label">*</span></label>	
					<div class="col-sm-8">
						{{ Form::text('name',null,array('placeholder'=>'Enter  Name','class'=>"form-control","id" => "name","onKeyup" => "createSlug('#name','#slug')"))}}
						@if ($errors->has('name'))
						<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
						@endif
					</div>
				</div>
				<div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
					<label for="slug" class="control-label text-left col-sm-4 required">Slug<span class="required-label">*</span></label>
					<div class="col-sm-8" >
						{{ Form::text('slug',null,array('placeholder'=>'Enter Slug','id' => 'slug','class'=>"form-control"))}}
						@if ($errors->has('slug'))
						<span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
						@endif
					</div>
				</div>
				<div class="form-group {{ $errors->has('relevent_keywords') ? ' has-error' : '' }}">
					<label for="relevent_keywords" class="control-label text-left col-sm-4 required">Relevent Keywords<span class="required-label">*</span></label>
					<div class="col-sm-8" >
						{{ Form::text('relevent_keywords',null,array('placeholder'=>'Enter Relevent Keywords','class'=>"form-control"))}}
						@if ($errors->has('relevent_keywords'))
						<span class="help-block"><strong>{{ $errors->first('relevent_keywords') }}</strong></span>
						@endif
					</div>
				</div>

				<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
					<label for="description" class="control-label text-left col-sm-4 required">Description</label>
					<div class="col-sm-8" >
						{{ Form::textarea('description',old('description'),['placeholder'=>'Enter Description','class'=>"form-control ckeditor"])}}
						@if ($errors->has('description'))
						<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
						@endif
					</div>
				</div>

				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						{!! Form::submit((isset($top100Form)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
						{!! Html::link(route('top-100-form.index'),'Cancel',['class'=>'btn btn-default']) !!}
					</div>
				</div>
				{{ Form::close() }}

			</div>
			<div class="col-xs-4 col-md-4">			
			
			</div>
			<!-- /.row -->
		</div>
	</div>
	</div>	

</section>
<!-- /.content -->

@endsection
@section('additionaljs')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
{!! JsValidator::formRequest('App\Http\Requests\Top100formFormRequest') !!}
@endsection