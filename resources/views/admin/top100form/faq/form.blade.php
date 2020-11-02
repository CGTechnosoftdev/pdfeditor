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
				{{ Form::model($form,['route' => ['top100form.faq.update',$form->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"]) }}
				{{ Form::hidden('id',$form->id,array())}}
				@else
				{{ Form::open(['route' => 'top100form.faq.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
				@endif
				{!! Form::token() !!}
			
				{{ Form::hidden('type_id',$frm_id,array())}}
				{{ Form::hidden('faq_type',$top_100_form,array())}}
				
				
			

				<div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
					<label for="question" class="control-label text-left col-sm-4 required">Question<span class="required-label">*</span></label>	
					<div class="col-sm-8">
						{{ Form::text('question',null,array('placeholder'=>'Enter Question','class'=>"form-control"))}}
						@if ($errors->has('question'))
						<span class="help-block"><strong>{{ $errors->first('question') }}</strong></span>
						@endif
					</div>
				</div>
			
				
				<div class="form-group {{ $errors->has('answer') ? ' has-error' : '' }}">
					<label for="answer" class="control-label text-left col-sm-4 required">Answer<span class="required-label">*</span></label>	
					<div class="col-sm-8">
						{{ Form::text('answer',null,array('placeholder'=>'Enter Answer','class'=>"form-control"))}}
						@if ($errors->has('answer '))
						<span class="help-block"><strong>{{ $errors->first('answer') }}</strong></span>
						@endif
					</div>
				</div>

				
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