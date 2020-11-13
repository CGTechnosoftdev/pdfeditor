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
					@if(isset($promo_url))
					{{ Form::model($promo_url,['route' => ['promo-url.update',$promo_url->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'promo-url.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<div class="col-xs-12 col-lg-6 col-md-9">
							<!-- promotion_name -->
							<div class="form-group {{ $errors->has('promotion_name') ? ' has-error' : '' }}">
								<label for="promotion_name" class="control-label text-left col-sm-4 required">Promotion Name
									<span class="required-label">*</span>
								</label>	
								<div class="col-sm-8">
									{{ Form::text('promotion_name',old('promotion_name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'promotion_name']) }}
									@if ($errors->has('promotion_name'))
									<span class="help-block"><strong>{{ $errors->first('promotion_name') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8">
									{!! Form::submit((isset($promo_url)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
									{!! Html::link(route('promo-url.index'),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\PromoUrlFormRequest') !!}
@endsection