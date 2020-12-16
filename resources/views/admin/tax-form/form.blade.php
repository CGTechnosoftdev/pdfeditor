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
					@if(isset($tax_form))
					{{ Form::model($tax_form,['route' => ['tax-form.update',$tax_form->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'tax-form.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<div class="col-xs-12 col-lg-6 col-md-9">
							<div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
								<label for="category_id" class="control-label text-left col-sm-4">
									Tax Category
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
									{{ Form::text('name',old('name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'name']) }}
									@if ($errors->has('name'))
									<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
									@endif
								</div>
							</div>
							@if(!isset($tax_form))
							<div class="form-group {{ $errors->has('version_name') ? ' has-error' : '' }}">
								<label for="version_name" class="control-label text-left col-sm-4">Version Name
									<span class="required-label">*</span>
								</label>
								<div class="col-sm-8">
									{{ Form::text('version_name',old('version_name'),['placeholder'=>'Enter Version Name','class'=>"form-control",'id'=>'version_name']) }}
									@if ($errors->has('version_name'))
									<span class="help-block"><strong>{{ $errors->first('version_name') }}</strong></span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('form') ? ' has-error' : '' }}">
								<label for="name" class="control-label text-left control-label col-sm-4 required">
									Form
									@if(empty($tax_form->form))
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

							<div class="form-group {{ $errors->has('fillable_printable_status') ? ' has-error' : '' }}">
								<label for="fillable_printable_status" class="control-label text-left col-sm-4 required">Fillable Printable Status</label>
								<div class="col-sm-8">
									{!! Form::select('fillable_printable_status',$yes_no_arr, old('fillable_printable_status'), ['class'=>'form-control required','data-unit'=>'from']) !!}
									@if ($errors->has('fillable_printable_status'))
									<span class="help-block"><strong>{{ $errors->first('fillable_printable_status') }}</strong></span>
									@endif
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
							@if(!isset($tax_form))
							<div class="form-group {{ $errors->has('version_description') ? ' has-error' : '' }}">
								<label for="version_description" class="control-label text-left col-sm-4">Version Description</label>
								<div class="col-sm-8">
									{{ Form::textarea('version_description',old('version_description'),['placeholder'=>'Description','class'=>"form-control",'id'=>'version_description']) }}
									@if ($errors->has('version_description'))
									<span class="help-block"><strong>{{ $errors->first('version_description') }}</strong></span>
									@endif
								</div>
							</div>
							@endif
							<div class="form-group {{ $errors->has('keywords') ? ' has-error' : '' }}">
								<label for="keywords" class="control-label text-left col-sm-4 required">Keywords</label>
								<div class="col-sm-8">
									{!! Form::select('keywords[]',($tax_form->keywords_arr ?? []), ($tax_form->keywords_arr ?? old('keywords_arr')), ['class'=>'form-control select2-token','multiple'=>true]) !!}
									@if ($errors->has('keywords'))
									<span class="help-block"><strong>{{ $errors->first('keywords') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									{!! Form::submit((isset($tax_form)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
									{!! Html::link(route('tax-form.index'),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\TaxFormFormRequest')->ignore('') !!}
@endsection