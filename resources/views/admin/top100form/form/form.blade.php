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
			<div class="col-xs-8 col-md-8">
				@if(isset($form))
				{{ Form::model($form,['route' => ['top100form.form.update',$form->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"]) }}
				{{ Form::hidden('id',$form->id,array())}}
				@else
				{{ Form::open(['route' => 'top100form.form.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
				@endif
				{!! Form::token() !!}
			
				{{ Form::hidden('type_id',$frm_id,array())}}
				{{ Form::hidden('form_type',$top_100_form,array())}}
				
			

				<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="control-label control-label col-sm-4 required">Name<span class="required-label">*</span></label>	
					<div class="col-sm-8">
						{{ Form::text('name',null,array('placeholder'=>'Enter Name','class'=>"form-control"))}}
						@if ($errors->has('name '))
						<span class="help-block"><strong>{{ $errors->first('name ') }}</strong></span>
						@endif
					</div>
				</div>
			
				{{ Form::hidden('form_file',1,array())}}

				
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						{!! Form::submit((isset($form)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
						{!! Html::link(route('top100form.form.list'),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\FormFormRequest') !!}
@endsection