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
					@if(isset($tax_calendar))
					{{ Form::model($tax_calendar,['route' => ['tax-calendar.update',$tax_calendar->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'tax-calendar.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}
					<div class="row">
						<div class="col-xs-12 col-lg-6 col-md-9">
							<div class="form-group {{ $errors->has('date') ? ' has-error' : '' }}">
								<label for="date" class="control-label text-left col-sm-4">Date
									<span class="required-label">*</span>
								</label>
								<div class="col-sm-8">
									{{ Form::text('date',old('date'),['class'=>"form-control datepicker",'id'=>'date','autocomplete'=>'off']) }}
									@if ($errors->has('date'))
									<span class="help-block"><strong>{{ $errors->first('date') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('tax_for') ? ' has-error' : '' }}">
								<label for="tax_for" class="control-label text-left col-sm-4">
									Tax Category
								</label>
								<div class="col-sm-8">
									{!! Form::select('tax_for',[''=>"General"] + $tax_for_arr, old('tax_for'), ['class'=>'form-control','id'=>'tax_for']) !!}
									@if ($errors->has('tax_for'))
									<span class="help-block"><strong>{{ $errors->first('tax_for') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group non-general-element {{ (!empty($tax_calendar) && $tax_calendar->tax_for != '') ? '' : 'hidden' }} {{ $errors->has('tax_form_id') ? ' has-error' : '' }}">
								<label for="tax_form_id" class="control-label text-left col-sm-4">
									Linked Tax Form<span class="required-label">*</span>
								</label>
								<div class="col-sm-8">
									{!! Form::select('tax_form_id',[''=>"Select"] + $tax_forms_arr, old('tax_form_id'), ['class'=>'form-control']) !!}
									@if ($errors->has('tax_form_id'))
									<span class="help-block"><strong>{{ $errors->first('tax_form_id') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group non-general-element {{ (!empty($tax_calendar) && $tax_calendar->tax_for != '') ? '' : 'hidden' }} {{ $errors->has('applicable_for') ? ' has-error' : '' }}">
								<label for="applicable_for" class="control-label text-left col-sm-4">Applicable For
								</label>
								<div class="col-sm-8">
									{{ Form::text('applicable_for',old('applicable_for'),['placeholder'=>'Ex : Individuals,Employees (including retirees),Estate or trust','class'=>"form-control",'id'=>'applicable_for']) }}
									@if ($errors->has('applicable_for'))
									<span class="help-block"><strong>{{ $errors->first('applicable_for') }}</strong></span>
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
									{!! Form::submit((isset($tax_calendar)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
									{!! Html::link(route('tax-calendar.index'),'Cancel',['class'=>'btn btn-default']) !!}
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
{!! JsValidator::formRequest('App\Http\Requests\TaxCalendarFormRequest') !!}
<script type="text/javascript">
	//Date picker
	$('.datepicker').datepicker({
		autoclose: true,
		format: "{{ (config('custom_config.js_date_format_arr')[config('general_settings.date_format')]) }}",
		todayHighlight: true,
	});
	$(document).ready(function() {
		$("#tax_for").change(function() {
			var tax_for_val = $(this).val();
			var target_element = '.non-general-element';
			if (tax_for_val == '') {
				$(target_element).addClass('hidden');
			} else {
				$(target_element).removeClass('hidden');

			}
		});
	});
</script>
@endsection