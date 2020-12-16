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
					@if(isset($tax_type))
					{{ Form::model($tax_type,['route' => ['tax-type.update',$tax_type->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'tax-type.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<div class="col-xs-12 col-lg-6 col-md-9">
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

							<div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
								<label for="slug" class="control-label text-left col-sm-4 required">Slug<span class="required-label">*</span></label>
								<div class="col-sm-8">
									{{ Form::text('slug',old('slug'),['placeholder'=>'Enter Slug','class'=>"form-control",'id'=>'slug'])}}
									@if ($errors->has('slug'))
									<span class="help-block"><strong>{{ $errors->first('slug') }}</strong></span>
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
									{!! Form::submit((isset($tax_type)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
									{!! Html::link(route('tax-type.index'),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\TaxFormTypeFormRequest') !!}
@endsection