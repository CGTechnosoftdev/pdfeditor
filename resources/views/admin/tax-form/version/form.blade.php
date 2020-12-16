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
					@if(isset($tax_form_version))
					{{ Form::model($tax_form_version,['route' => ['tax-form.version.update',$tax_form->id,$tax_form_version->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => ['tax-form.version.store',$tax_form->id],'method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<div class="col-xs-12 col-lg-6 col-md-9">

							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="control-label text-left col-sm-4">Name
									<span class="required-label">*</span>
								</label>
								<div class="col-sm-8">
									{{ Form::text('name',old('name'),['placeholder'=>'Enter Version Name','class'=>"form-control",'id'=>'name']) }}
									@if ($errors->has('name'))
									<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('form') ? ' has-error' : '' }}">
								<label for="name" class="control-label text-left control-label col-sm-4 required">
									Form
									@if(empty($tax_form_version->form))
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
							@if(!empty($tax_form_version->form))
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									<a href="{{$tax_form_version->form_url}}" target="_new" title="Form">
										<i class="fa fa-file-pdf-o"></i>
									</a>
								</div>
							</div>
							@endif
							<div class="form-group {{ $errors->has('fillable_printable_status') ? ' has-error' : '' }}">
								<label for="fillable_printable_status" class="control-label text-left col-sm-4 required">Fillable Printable Status</label>
								<div class="col-sm-8">
									{!! Form::select('fillable_printable_status',$yes_no_arr, old('fillable_printable_status'), ['class'=>'form-control required','data-unit'=>'from']) !!}
									@if ($errors->has('fillable_printable_status'))
									<span class="help-block"><strong>{{ $errors->first('fillable_printable_status') }}</strong></span>
									@endif
								</div>
							</div>

							<div class="form-group {{ $errors->has('is_latest_version') ? ' has-error' : '' }}">
								<label for="is_latest_version" class="control-label text-left col-sm-4 required">Is latest version?</label>
								<div class="col-sm-8">
									{{ Form::checkbox('is_latest_version',1,old('is_latest_version'),['class'=>'styled-checkbox','id'=>'is_latest_version']) }}
									<label for="is_latest_version"></label>
									@if ($errors->has('is_latest_version'))
									<span class="help-block"><strong>{{ $errors->first('is_latest_version') }}</strong></span>
									@endif
								</div>
							</div>
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
									{!! Form::submit((isset($tax_form_version)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
									{!! Html::link(route('tax-form.version.list',$tax_form->id),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\TaxFormVersionFormRequest') !!}
@endsection