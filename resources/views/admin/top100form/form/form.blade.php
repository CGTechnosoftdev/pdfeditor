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
					@if(isset($form))
					{{ Form::model($form,['route' => ['top100form.form.update',$top_100_form->id,$form->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => ['top100form.form.store',$top_100_form->id],'method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}

					<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="control-label text-left control-label col-sm-4 required">Name<span class="required-label">*</span></label>	
						<div class="col-sm-8">
							{{ Form::text('name',null,array('placeholder'=>'Enter Name','class'=>"form-control"))}}
							@if ($errors->has('name '))
							<span class="help-block"><strong>{{ $errors->first('name ') }}</strong></span>
							@endif
						</div>
					</div>

					<div class="form-group {{ $errors->has('form_file') ? ' has-error' : '' }}">
						<label for="name" class="control-label text-left control-label col-sm-4 required">Form File
							@if(empty($form))
							<span class="required-label">*</span>	
							@endif
						</label>
						<div class="col-sm-8">
							{{ Form::file('form_file',old('form_file'),array('class'=>"form-control"))}}
							@if($errors->has('form_file'))
							<span class="help-block"><strong>{{ $errors->first('form_file') }}</strong></span>
							@endif							
						</div>
					</div>
					@if(!empty($form->form_file))
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<a href="{{$form->form_file_url}}" target="_new" title="Click here to open!">
								<i class="fa fa-file-pdf-o"></i>
							</a>			
						</div>
					</div>			  					
					@endif

					<div class="form-group {{ $errors->has('fillable_printable_status') ? ' has-error' : '' }}">
						<label for="fillable_printable_status" class="control-label text-left col-sm-4 required">Fillable Printable Status</label>
						<div class="col-sm-8" >
							{!! Form::select('fillable_printable_status',[''=>"Select"] + $yes_no_arr, old('fillable_printable_status'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							@if ($errors->has('fillable_printable_status'))
							<span class="help-block"><strong>{{ $errors->first('fillable_printable_status') }}</strong></span>
							@endif		
						</div>						
					</div>

					<div class="form-group {{ $errors->has('is_latest_version') ? ' has-error' : '' }}">
						<label for="is_latest_version" class="control-label text-left col-sm-4 required">Is latest version?</label>
						<div class="col-sm-8" >							
							{{ Form::checkbox('is_latest_version',1,old('is_latest_version'),['class'=>'styled-checkbox','id'=>'is_latest_version']) }}
							<label for="is_latest_version"></label>
							@if ($errors->has('is_latest_version'))
							<span class="help-block"><strong>{{ $errors->first('is_latest_version') }}</strong></span>
							@endif		
						</div>						
					</div>


					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							{!! Form::submit((isset($form)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
							{!! Html::link(route('top100form.form.list',$top_100_form->id),'Cancel',['class'=>'btn btn-default']) !!}
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

{!! JsValidator::formRequest('App\Http\Requests\Top100formVersionFormRequest') !!}
@endsection