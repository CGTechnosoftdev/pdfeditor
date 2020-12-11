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
					@if(isset($business_category))
					{{ Form::model($business_category,['route' => ['business-category.update',$business_category->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'business-category.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}

					<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="control-label text-left col-sm-4 required">Name<span class="required-label">*</span></label>	
						<div class="col-sm-8">
							{{ Form::text('name',old('name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'name',"onKeyup" => "createSlug('#name','#slug')"]) }}
							@if ($errors->has('name'))
							<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
						<label for="slug" class="control-label text-left col-sm-4 required">Slug<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('slug',old('slug'),['placeholder'=>'Enter Slug','class'=>"form-control",'id'=>'slug'])}}
							@if ($errors->has('slug'))
							<span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('heading') ? ' has-error' : '' }}">
						<label for="heading" class="control-label text-left col-sm-4 required">Heading<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('heading',old('heading'),['placeholder'=>'Enter Heading','class'=>"form-control"])}}
							@if ($errors->has('heading'))
							<span class="help-block"><strong>{{ $errors->first('heading') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('short_description') ? ' has-error' : '' }}">
						<label for="short_description" class="control-label text-left col-sm-4 required">Short Description<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('short_description',old('short_description'),['placeholder'=>'Enter Short Description','class'=>"form-control"])}}
							@if ($errors->has('short_description'))
							<span class="help-block"><strong>{{ $errors->first('short_description') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
						<label for="description" class="control-label text-left col-sm-4 required">Description</label>
						<div class="col-sm-8" >
							{{ Form::textarea('description',old('description'),['placeholder'=>'Enter Description','class'=>"form-control"])}}
							@if ($errors->has('description'))
							<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							{!! Form::submit((isset($business_category)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
							{!! Html::link(route('business-category.index'),'Cancel',['class'=>'btn btn-default']) !!}
						</div>
					</div>
					{{ Form::close() }}
				</div>
				<div class="col-xs-12 col-lg-6 col-md-3">	
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
{!! JsValidator::formRequest('App\Http\Requests\BusinessCategoryFormRequest') !!}
@endsection