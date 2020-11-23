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
					@if(isset($email_template))
					{{ Form::model($email_template,['route' => ['email-template.update',$email_template->id],'method'=>'put','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'email-template.store','method'=>'post','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<!-- title -->
						<div class="col-lg-6 col-md-9 col-sm-12">
							<div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">								
								<div class="col-md-4 col-sm-4">
									{!! Form::label('title', 'Title',['class'=>'control-label']) !!}
									<span class="required-label">*</span>
								</div>																
								<div class="col-md-8 col-sm-8">
									{{ Form::text('title',null,array('placeholder'=>'Enter title','class'=>"form-control"))}}
									@if ($errors->has('title'))
									<span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="row form-group{{ $errors->has('subject') ? ' has-error' : '' }}">								
								<div class="col-md-4 col-sm-4">
									{!! Form::label('subject', 'Subject',['class'=>'control-label']) !!}
									<span class="required-label">*</span>
								</div>																
								<div class="col-md-8 col-sm-8">
									{{ Form::text('subject',null,array('placeholder'=>'Enter subject','class'=>"form-control"))}}
									@if ($errors->has('subject'))
									<span class="help-block"><strong>{{ $errors->first('subject') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="row form-group">								
								<div class="col-md-4 col-sm-4">
									{!! Html::decode(Form::label('place_holders', 'Email Place Holders <small> (These place holders can be used in content)</small>')) !!}
								</div>																
								<div class="col-md-8 col-sm-8">
									{{ $email_template->place_holders }}
								</div>
							</div>
							<div class="row form-group {{ $errors->has('content') ? ' has-error' : '' }}">								
								<div class="col-md-4 col-sm-4">
									{!! Form::label('content', 'Content',['class'=>'control-label ']) !!}
									<span class="required-label">*</span>
								</div>																
								<div class="col-md-8 col-sm-8">
									{{ Form::textarea('content',null,array('placeholder'=>'Enter content','class'=>"form-control ckeditor"))}}
									@if ($errors->has('content'))
									<span class="help-block"><strong>{{ $errors->first('content') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									{!! Form::submit((isset($email_template)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
									{!! Html::link(route('email-template.index'),'Cancel',['class'=>'btn btn-default']) !!}
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<!-- {!! JsValidator::formRequest('App\Http\Requests\EmailTemplateFormRequest') !!} -->
@endsection