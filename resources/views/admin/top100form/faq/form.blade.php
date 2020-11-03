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
					@if(isset($faq))
					{{ Form::model($faq,['route' => ['top100form.faq.update', $top_100_form->id,$faq->id],'class'=>'form-horizontal','method'=>'put','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => ['top100form.faq.store',$top_100_form->id],'method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}

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
							{{ Form::textarea('answer',null,array('placeholder'=>'Enter Answer','class'=>"form-control"))}}
							@if ($errors->has('answer '))
							<span class="help-block"><strong>{{ $errors->first('answer') }}</strong></span>
							@endif
						</div>

					</div>


					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							{!! Form::submit((isset($faq)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
							{!! Html::link(route('top100form.faq.list',$top_100_form->id),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\FaqFormRequest') !!}
@endsection