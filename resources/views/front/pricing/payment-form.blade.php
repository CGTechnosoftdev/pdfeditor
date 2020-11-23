@extends('layouts.front-home')
@section("content")
<section class="pricing-banner payment-banner" style="background: url({{url('public/front/images/payment-bg.svg')}});">
	<div class="banner-content">
		@if(!empty($trail_days))
		<div class="container">
			<h1>Enter your payment information to <strong>Start your {{$trail_days}} Day Free Trial</strong></h1>

			<div class="first-charging">
				<span class="charging-text">Your first charge will be after your <span class="dark-text">{{$trail_days}} day free trial</span> ends</span>
				<span class="question-icon"><i class="fas fa-question-circle"></i></span>
			</div>

		</div>
		@endif
	</div>
</section>
{{ Form::open(['route' => ['front.checkout',$subscription_plan->id],'method'=>'post','enctype'=>"multipart/form-data","id"=>'payment-form']) }}
{!! Form::token() !!}
<section class="purchase-summary">
	<div class="container">
		@include('admin.partials.flash-messages')
		<div class="row">
			<div class="col-md-12 purchase-heading text-left">
				<h3>Purchase <span class="green-color">Summary</span></h3>
				@foreach($subscription_plan_type_arr as $plan_type_id => $plan_type)
				<p class="{{strtolower($plan_type)}}-element {{$subscription_plan_type==$plan_type_id ? '' : 'd-none'}}">
					{{$subscription_plan->name}} ({{$plan_type}})
					<!-- + <small class="green-color">Free SignNow {{$subscription_plan->name}}</small> --> & Free 360Legal Forms
				</p>
				@endforeach
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="heading-top">
					<div class="left-box">
						<div class="left-part">
							@if(!empty($trail_days))
							<strong>Today's charge:<b>{{myCurrencyFormat('0.00')}}</b></strong>
							@foreach($subscription_plan_type_arr as $plan_type_id => $plan_type)
							@php $type = strtolower($plan_type)."_amount"; @endphp
							<span class="{{strtolower($plan_type)}}-element {{$subscription_plan_type==$plan_type_id ? '' : 'd-none'}}">
								After {{$trail_days}} days {{myCurrencyFormat($subscription_plan->$type)}} {{strtolower($plan_type)}}
							</span>
							@endforeach
							@else
							@foreach($subscription_plan_type_arr as $plan_type_id => $plan_type)
							@php $type = strtolower($plan_type)."_amount"; @endphp
							<strong class="{{strtolower($plan_type)}}-element {{$subscription_plan_type==$plan_type_id ? '' : 'd-none'}}">
								Today's charge:<b>{{myCurrencyFormat($subscription_plan->$type)}}</b>
							</strong>
							@endforeach
							@endif
						</div>

						<ul class="annual">
							@foreach($subscription_plan_type_arr as $plan_type_id => $plan_type)
							<li>
								<div class="my-radio-btn">
									<input id="radio-{{$plan_type_id}}" name="subscription_plan_type" value="{{$plan_type_id}}" type="radio" {{$subscription_plan_type==$plan_type_id ? 'checked=true' : ''}} class="subscription_plan_type" data-id='{{$subscription_plan->id}}' data-type='{{strtolower($plan_type)}}'>
									<label for="radio-{{$plan_type_id}}" class="radio-label">{{$plan_type}}</label>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="heading-top">
					<!-- <div class="right-part">
						<ul>
							<li class="active"><img src="{{ asset('public/front/images/pay.svg') }}"></li>
							<li><img src="{{ asset('public/front/images/google-pay.svg') }}"></li>
							<li><img src="{{ asset('public/front/images/pay-pal.svg') }}"></li>
						</ul>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</section>

<section class="credit-card-info mb-5 mt-5">
	<div class="container">
		<div class="credit-card-part py-5 px-2 px-sm-5">
			<div class="row">
				<div class="col-md-10 offset-md-1 signnow-heading text-center mb-4">
					<h3>Credit Card <span class="green-color"> Information</span></h3>
				</div>
				<div class="col-md-10 offset-md-1 signnow-heading mb-4">
					<div class="row">
						<div class="col-md-6 form-group mb-3 {{ $errors->has('first_name') ? ' has-error' : '' }}">
							<label for="first_name" class="control-label w-100 required">
								First Name<span class="required-label">*</span>
							</label>
							{{ Form::text('first_name',old('first_name'),['placeholder'=>'Enter First Name','class'=>"form-control",'id'=>'first_name'])}}
							@if ($errors->has('first_name'))
							<span class="help-block"><strong>{{ $errors->first('first_name') }}</strong></span>
							@endif
						</div>
						<div class="col-md-6 form-group mb-3 {{ $errors->has('last_name') ? ' has-error' : '' }}">
							<label for="last_name" class="control-label w-100 required">
								Last Name<span class="required-label">*</span>
							</label>
							{{ Form::text('last_name',old('last_name'),['placeholder'=>'Enter Last Name','class'=>"form-control",'id'=>'last_name'])}}
							@if ($errors->has('last_name'))
							<span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>
							@endif
						</div>
						<div class="col-md-6 form-group mb-3 {{ $errors->has('card_number') ? ' has-error' : '' }}">
							<label for="card_number" class="control-label w-100 required">
								Card Number<span class="required-label">*</span>
							</label>
							{{ Form::text('card_number',old('card_number'),['placeholder'=>'Enter Card Number','class'=>"form-control",'id'=>'card_number','data-inputmask'=>'"mask": "9999-9999-9999-9999"','data-mask'])}}
							@if ($errors->has('card_number'))
							<span class="help-block"><strong>{{ $errors->first('card_number') }}</strong></span>
							@endif
						</div>
						<div class="col-md-6 form-group mb-3">
							<div class="visamastercard pt-4 mt-2">
								<img src="{{ asset('public/front/images/visa-mastercard.png') }}">
							</div>
						</div>
						<div class="col-md-5 form-group mb-3 {{ $errors->has('expiry_date') ? ' has-error' : '' }}">
							<label for="expiry_date" class="control-label w-100 required">
								Expiry Date<span class="required-label">*</span>
							</label>
							{{ Form::text('expiry_date',old('expiry_date'),['placeholder'=>'MM/YYYY','class'=>"form-control",'id'=>'expiry_date','data-inputmask'=>'"alias": "mm/yyyy"','data-mask'])}}
							@if ($errors->has('expiry_date'))
							<span class="help-block"><strong>{{ $errors->first('expiry_date') }}</strong></span>
							@endif
						</div>
						<div class="col-md-3 form-group mb-3 {{ $errors->has('cvv') ? ' has-error' : '' }}">
							<label for="cvv" class="w-100 d-flex justify-content-between">
								CVV/CVC<span class="required-label d-content">*</span>
								<span class="green-color"><i class="fas fa-question-circle"></i></span>
							</label>
							{{ Form::password('cvv',['placeholder'=>'XXX','class'=>"form-control",'id'=>'cvv'])}}
							@if ($errors->has('cvv'))
							<span class="help-block"><strong>{{ $errors->first('cvv') }}</strong></span>
							@endif
						</div>
						<div class="col-md-4 form-group mb-3 {{ $errors->has('zip_code') ? ' has-error' : '' }}">
							<label for="zip_code" class="control-label w-100 required">
								Zip Code<span class="required-label">*</span>
							</label>
							{{ Form::text('zip_code',old('zip_code'),['placeholder'=>'Enter Zip Code','class'=>"form-control",'id'=>'zip_code'])}}
							@if ($errors->has('zip_code'))
							<span class="help-block"><strong>{{ $errors->first('zip_code') }}</strong></span>
							@endif
						</div>

						<div class="col-md-12">
							<div class="w-100 mb-4 mt-2 justify-content-between text-center">
								<div class="custom-control custom-checkbox mr-sm-2">
									<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
									<label class="custom-control-label" for="customControlAutosizing">I have agree to the <a href="">Terms & Conditions</a></label>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-sm-5">
							@if(!empty($trail_days))
							{!! Form::button('Start my free '.$trail_days.' days trial',['type'=>'submit','class'=>'w-100 btn btn-secondary']) !!}
							@else
							{!! Form::button('Pay Now',['type'=>'submit','class'=>'w-100 btn btn-secondary']) !!}
							@endif
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
{{ Form::close() }}
@include('front.blocks.solve-pdf-problems')
@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\PaymentFormRequest','#payment-form') !!}
<script src="{{ asset('public/admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('public/admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('public/admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script type="text/javascript">
	$('[data-mask]').inputmask();
	$(document).on('change', '.subscription_plan_type', function(e) {
		e.preventDefault();
		var plan_type = $(this).attr('data-type'); //$(this).attr('data-type');
		var current_plan = ((plan_type == 'yearly') ? 'monthly' : 'yearly');
		var target_plan = plan_type;
		$('.' + target_plan + '-element').removeClass('d-none');
		$('.' + current_plan + '-element').addClass('d-none');
	})
</script>
@append