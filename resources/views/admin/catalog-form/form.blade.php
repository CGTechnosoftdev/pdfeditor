@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					@if(isset($catalog_form))
					{{ Form::model($catalog_form,['route' => ['catalog-form.update',$catalog_form->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'catalog-form.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<div class="col-xs-12 col-lg-6 col-md-9">
							<div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
								<label for="category_id" class="control-label text-left col-sm-4">
									Catalog Category
									<span class="required-label">*</span>
								</label>
								<div class="col-sm-8">
									{!! Form::select('category_id',[''=>"Select"] + $category_arr, old('category_id'), ['class'=>'form-control']) !!}
									@if ($errors->has('category_id'))
									<span class="help-block"><strong>{{ $errors->first('category_id') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="control-label text-left col-sm-4">Name
									<span class="required-label">*</span>
								</label>
								<div class="col-sm-8">
									{{ Form::text('name',old('name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'name',"onKeyup" => "createSlug('#name','#slug')"]) }}
									@if ($errors->has('name'))
									<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('form') ? ' has-error' : '' }}">
								<label for="name" class="control-label text-left control-label col-sm-4 required">
									Form
									@if(empty($catalog_form->form))
									<span class="required-label">*</span>
									@endif
								</label>
								<div class="col-sm-8">
									<div class="browse-file">
										<!-- actual upload which is hidden -->
										<!-- <input type="file" id="actual-btn" /> -->
										<!-- our custom upload button -->
										<label for="actual-btn">Choose File</label>
										<!-- name of file chosen -->
										<span id="file-chosen">No file chosen</span>
									</div>
									{{ Form::file('form',array('class'=>"form-control",'id'=>'actual-btn','style'=>"display:none;"))}}
									@if($errors->has('form'))
									<span class="help-block"><strong>{{ $errors->first('form') }}</strong></span>
									@endif
								</div>
							</div>
							@if(!empty($catalog_form->form))
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<a href="{{$catalog_form->form_url}}" target="_new" title="Form">
										<i class="fa fa-file-pdf-o"></i>
									</a>
								</div>
							</div>
							@endif

							<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
								<label for="description" class="control-label text-left col-sm-4">Description</label>
								<div class="col-sm-8">
									{{ Form::textarea('description',old('description'),['placeholder'=>'Description','class'=>"form-control",'id'=>'description']) }}
									@if ($errors->has('description'))
									<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
									@endif
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									{!! Form::submit((isset($catalog_form)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
									{!! Html::link(route('catalog-form.index'),'Cancel',['class'=>'btn btn-default']) !!}
								</div>
							</div>
						</div>
					</div>
					{{ Form::close() }}

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>

	</div>
	<!-- /.row -->

</section>
<!-- /.content -->

@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\CatalogFormFormRequest')->ignore('') !!}
@endsection