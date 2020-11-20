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
							<h4>Promotion</h4>
							<div class="form-group {{ $errors->has('subscription_plan_id') ? ' has-error' : '' }}">
								<label for="subscription_plan_id" class="control-label text-left col-sm-4">Subscription Plan<span class="required-label">*</span></label>
								<div class="col-sm-8" >
									{!! Form::select('subscription_plan_id',[''=>"Select"] + $subscription_plan_arr, old('subscription_plan_id'), ['class'=>'form-control','data-unit'=>'from']) !!}
									@if ($errors->has('subscription_plan_id'))
									<span class="help-block"><strong>{{ $errors->first('subscription_plan_id') }}</strong></span>
									@endif		
								</div>						
							</div>
							<!-- promotion_name -->
							<div class="form-group {{ $errors->has('promotion_name') ? ' has-error' : '' }}">
								<label for="promotion_name" class="control-label text-left col-sm-4">Promotion Name
									<span class="required-label">*</span>
								</label>	
								<div class="col-sm-8">
									{{ Form::text('promotion_name',old('promotion_name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'promotion_name']) }}
									@if ($errors->has('promotion_name'))
									<span class="help-block"><strong>{{ $errors->first('promotion_name') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('trail_days') ? ' has-error' : '' }}">
								<label for="trail_days" class="control-label text-left col-sm-4">Trail Days</label>	
								<div class="col-sm-8">
									{{ Form::number('trail_days',old('trail_days'),['placeholder'=>'Enter Trail Days','class'=>"form-control",'id'=>'trail_days','step'=>1,'min'=>0]) }}
									@if ($errors->has('trail_days'))
									<span class="help-block"><strong>{{ $errors->first('trail_days') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('monthly_amount_type') ? ' has-error' : '' }}">
								<label for="monthly_amount_type" class="control-label text-left col-sm-4">Monthly Amount</label>
								<div class="col-sm-8" >
									@php $selected_monthly_amount_type = old('monthly_amount_type') ?? config('constant.DEFAULT_AMOUNT_TYPE') @endphp
									@foreach($amount_type_arr as $key => $amount_type)
									<div class="my-radio">
										{!! Form::radio('monthly_amount_type', $key, ($selected_monthly_amount_type ==  $key), ['id'=>'monthly_amount_type-'.$key,'class'=>'amount_type_checkbox','data-type'=>$amount_type,'data-plan_type'=>'monthly_amount']) !!}
										<label for="{{'monthly_amount_type-'.$key}}">{{$amount_type}}</label>
									</div>
									@endforeach							
									@if ($errors->has('monthly_amount_type'))
									<span class="help-block"><strong>{{ $errors->first('monthly_amount_type') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('monthly_amount') ? ' has-error' : '' }} Custom_monthly_amount {{ (empty($promo_url) || $promo_url->monthly_amount_type == config('constant.DEFAULT_AMOUNT_TYPE')) ? 'hidden' : '' }}">
								<div class="col-sm-offset-4 col-sm-8" >
									{{ Form::number('monthly_amount',old('monthly_amount'),['placeholder'=>'Enter Custom Monthly Amount','class'=>"form-control",'min'=>0, 'step'=>0.50])}}
									@if ($errors->has('monthly_amount'))
									<span class="help-block"><strong>{{ $errors->first('monthly_amount') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('valid_for_months') ? ' has-error' : '' }}">
								<label for="valid_for_months" class="control-label text-left col-sm-4">Valid for Months</label>
								<div class="col-sm-8" >
									{!! Form::select('valid_for_months',[''=>"Select"] + $valid_for_months_arr, old('valid_for_months'), ['class'=>'form-control','data-unit'=>'from']) !!}
									@if ($errors->has('valid_for_months'))
									<span class="help-block"><strong>{{ $errors->first('valid_for_months') }}</strong></span>
									@endif		
								</div>						
							</div>		
							<div class="form-group {{ $errors->has('yearly_amount_type') ? ' has-error' : '' }}">
								<label for="yearly_amount_type" class="control-label text-left col-sm-4">Yearly Amount</label>
								<div class="col-sm-8" >
									@php $selected_yearly_amount_type = old('yearly_amount_type') ?? config('constant.DEFAULT_AMOUNT_TYPE') @endphp
									@foreach($amount_type_arr as $key => $amount_type)
									<div class="my-radio">
										{!! Form::radio('yearly_amount_type', $key, ($selected_yearly_amount_type ==  $key), ['id'=>'yearly_amount_type-'.$key,'class'=>'amount_type_checkbox','data-type'=>$amount_type,'data-plan_type'=>'yearly_amount']) !!}
										<label for="{{'yearly_amount_type-'.$key}}">{{$amount_type}}</label>
									</div>
									@endforeach							
									@if ($errors->has('yearly_amount_type'))
									<span class="help-block"><strong>{{ $errors->first('yearly_amount_type') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('yearly_amount') ? ' has-error' : '' }} Custom_yearly_amount {{ (empty($promo_url) || $promo_url->yearly_amount_type == config('constant.DEFAULT_AMOUNT_TYPE')) ? 'hidden' : '' }}">
								<div class="col-sm-offset-4 col-sm-8" >
									{{ Form::number('yearly_amount',old('yearly_amount'),['placeholder'=>'Enter Custom Yearly Amount','class'=>"form-control",'min'=>0, 'step'=>0.50])}}
									@if ($errors->has('yearly_amount'))
									<span class="help-block"><strong>{{ $errors->first('yearly_amount') }}</strong></span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('valid_for_years') ? ' has-error' : '' }}">
								<label for="valid_for_years" class="control-label text-left col-sm-4">Valid for Years</label>
								<div class="col-sm-8" >
									{!! Form::select('valid_for_years',[''=>"Select"] + $valid_for_years_arr, old('valid_for_years'), ['class'=>'form-control','data-unit'=>'from']) !!}
									@if ($errors->has('valid_for_years'))
									<span class="help-block"><strong>{{ $errors->first('valid_for_years') }}</strong></span>
									@endif		
								</div>						
							</div>									
							<div class="form-group {{ $errors->has('expiration_date') ? ' has-error' : '' }}">
								<label for="expiration_date" class="control-label text-left col-sm-4">Expiration Date</label>	
								<div class="col-sm-8">
									{{ Form::text('expiration_date',old('expiration_date'),['placeholder'=>'Expiration Date','class'=>"form-control",'id'=>'expiration_date']) }}
									@if ($errors->has('expiration_date'))
									<span class="help-block"><strong>{{ $errors->first('expiration_date') }}</strong></span>
									@endif
								</div>
							</div>		
							<h4>UTM Parameters</h4>		

							<div class="form-group {{ $errors->has('campaign_source') ? ' has-error' : '' }}">
								<label for="campaign_source" class="control-label text-left col-sm-4">Campaign Source</label>	
								<div class="col-sm-8">
									{{ Form::text('campaign_source',old('campaign_source'),['placeholder'=>'Campaign Source','class'=>"form-control",'id'=>'campaign_source']) }}
									@if ($errors->has('campaign_source'))
									<span class="help-block"><strong>{{ $errors->first('campaign_source') }}</strong></span>
									@endif
								</div>
							</div>		
							<div class="form-group {{ $errors->has('campaign_medium') ? ' has-error' : '' }}">
								<label for="campaign_medium" class="control-label text-left col-sm-4">Campaign Medium</label>	
								<div class="col-sm-8">
									{{ Form::text('campaign_medium',old('campaign_medium'),['placeholder'=>'Campaign Medium','class'=>"form-control",'id'=>'campaign_medium']) }}
									@if ($errors->has('campaign_medium'))
									<span class="help-block"><strong>{{ $errors->first('campaign_medium') }}</strong></span>
									@endif
								</div>
							</div>		
							<div class="form-group {{ $errors->has('campaign_name') ? ' has-error' : '' }}">
								<label for="campaign_name" class="control-label text-left col-sm-4">Campaign Name</label>	
								<div class="col-sm-8">
									{{ Form::text('campaign_name',old('campaign_name'),['placeholder'=>'Campaign Name','class'=>"form-control",'id'=>'campaign_name']) }}
									@if ($errors->has('campaign_name'))
									<span class="help-block"><strong>{{ $errors->first('campaign_name') }}</strong></span>
									@endif
								</div>
							</div>		
							<div class="form-group {{ $errors->has('campaign_term') ? ' has-error' : '' }}">
								<label for="campaign_term" class="control-label text-left col-sm-4">Campaign Term</label>	
								<div class="col-sm-8">
									{{ Form::text('campaign_term',old('campaign_term'),['placeholder'=>'Campaign Term','class'=>"form-control",'id'=>'campaign_term']) }}
									@if ($errors->has('campaign_term'))
									<span class="help-block"><strong>{{ $errors->first('campaign_term') }}</strong></span>
									@endif
								</div>
							</div>		
							<div class="form-group {{ $errors->has('campaign_content') ? ' has-error' : '' }}">
								<label for="campaign_content" class="control-label text-left col-sm-4">Campaign Content</label>	
								<div class="col-sm-8">
									{{ Form::text('campaign_content',old('campaign_content'),['placeholder'=>'Campaign Content','class'=>"form-control",'id'=>'campaign_content']) }}
									@if ($errors->has('campaign_content'))
									<span class="help-block"><strong>{{ $errors->first('campaign_content') }}</strong></span>
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
<script type="text/javascript">
	$(document).ready(function() {
		$(".amount_type_checkbox").click(function() {
			var plan_type = $(this).attr('data-plan_type');
			var type = $(this).attr('data-type');
			var target_element ='Custom_'+plan_type;
			console.log(target_element);
			if(type == 'Custom'){
				$('.'+target_element).removeClass('hidden');
			}else{
				$('.'+target_element).addClass('hidden');

			}
		});
	});
</script>
{!! JsValidator::formRequest('App\Http\Requests\PromoUrlFormRequest') !!}
@endsection