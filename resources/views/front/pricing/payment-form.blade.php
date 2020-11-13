<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	<!-- Styles -->
	<style>
		html, body {
			background-color: #fff;
			color: #636b6f;
			font-family: 'Nunito', sans-serif;
			font-weight: 200;
			height: 100vh;
			margin: 0;
		}

		.full-height {
			height: 100vh;
		}

		.flex-center {
			align-items: center;
			display: flex;
			justify-content: center;
		}

		.position-ref {
			position: relative;
		}

		.top-right {
			position: absolute;
			right: 10px;
			top: 18px;
		}

		.content {
			text-align: center;
		}

		.title {
			font-size: 84px;
		}

		.links > a {
			color: #636b6f;
			padding: 0 25px;
			font-size: 13px;
			font-weight: 600;
			letter-spacing: .1rem;
			text-decoration: none;
			text-transform: uppercase;
		}

		.m-b-md {
			margin-bottom: 30px;
		}
	</style>
</head>
<body>
	<div class="flex-center position-ref full-height">
		@if (Route::has('login'))
		<div class="top-right links">
			@guest
			<a href="{{ route('front.login') }}">Login</a>
			@else
			<a href="{{ route('front.logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
				Logout out
			</a>
			<form id="logout-form" action="{{ route('front.logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
			@endguest
		</div>
		@endif
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-lg-12 col-md-12">
					{{ Form::open(['route' => 'front.checkout','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					{!! Form::token() !!}
					<div class="form-group {{ $errors->has('subscription_plan_id') ? ' has-error' : '' }}">
						<label for="subscription_plan_id" class="control-label text-left col-sm-4 required">Subscription Plan<span class="required-label">*</span></label>	
						<div class="col-sm-8">
							{!! Form::select('subscription_plan_id',[''=>"Select"] + $subscription_plan_arr, old('subscription_plan_id'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							@if ($errors->has('subscription_plan_id'))
							<span class="help-block"><strong>{{ $errors->first('subscription_plan_id') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('subscription_plan_type_id') ? ' has-error' : '' }}">
						<label for="subscription_plan_type_id" class="control-label text-left col-sm-4 required">Subscription Plan Type<span class="required-label">*</span></label>	
						<div class="col-sm-8">
							{!! Form::select('subscription_plan_type_id',[''=>"Select"] + $subscription_plan_type_arr, old('subscription_plan_type_id'), ['class'=>'form-control required','data-unit'=>'from']) !!}
							@if ($errors->has('subscription_plan_type_id'))
							<span class="help-block"><strong>{{ $errors->first('subscription_plan_type_id') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('card_number') ? ' has-error' : '' }}">
						<label for="card_number" class="control-label text-left col-sm-4 required">Card Number<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('card_number',old('card_number'),['placeholder'=>'XXXX-XXXX-XXXX-XXXX','class'=>"form-control",'id'=>'card_number'])}}
							@if ($errors->has('card_number'))
							<span class="help-block"><strong>{{ $errors->first('card_number') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('name_on_card') ? ' has-error' : '' }}">
						<label for="name_on_card" class="control-label text-left col-sm-4 required">Name on card<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('name_on_card',old('name_on_card'),['placeholder'=>'Enter Name on Card','class'=>"form-control",'id'=>'name_on_card'])}}
							@if ($errors->has('name_on_card'))
							<span class="help-block"><strong>{{ $errors->first('name_on_card') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('expiry_month') ? ' has-error' : '' }}">
						<label for="expiry_month" class="control-label text-left col-sm-4 required">Expiry Month<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('expiry_month',old('expiry_month'),['placeholder'=>'MM','class'=>"form-control"])}}
							@if ($errors->has('expiry_month'))
							<span class="help-block"><strong>{{ $errors->first('expiry_month') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('expiry_year') ? ' has-error' : '' }}">
						<label for="expiry_year" class="control-label text-left col-sm-4 required">Expiry Year<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('expiry_year',old('expiry_year'),['placeholder'=>'YYYY','class'=>"form-control"])}}
							@if ($errors->has('expiry_year'))
							<span class="help-block"><strong>{{ $errors->first('expiry_year') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('cvv') ? ' has-error' : '' }}">
						<label for="cvv" class="control-label text-left col-sm-4 required">CVV<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::password('cvv',old('cvv'),['placeholder'=>'XXX','class'=>"form-control"])}}
							@if ($errors->has('cvv'))
							<span class="help-block"><strong>{{ $errors->first('cvv') }}</strong></span>
							@endif
						</div>
					</div><br>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							{!! Form::submit('Pay Now',['class'=>'btn btn-success']) !!}
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>

		</div>
	</div>
</body>
</html>
