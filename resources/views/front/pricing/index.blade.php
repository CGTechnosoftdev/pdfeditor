@extends('layouts.front-home')
@section("content")
<section class="pricing-banner" style="background: url({{url('public/front/images/pricing-banner-bg.svg')}});">
	<div class="banner-content">
		<div class="container">
			<h1><strong>Choose a plan</strong> to try out PDF Writer risk free You can switch plans or cancel anytime</h1>

			<div class="pricing-plans pt-5 mt-5">
				<div class="row">
					@foreach($subscription_plan_arr as $subscription_plan)
					<div class="col-md-4 col-sm-6">
						{{ Form::open(['route' => ['front.payment-form',$subscription_plan->id],'method'=>'get']) }}
						<div class="card mb-5 mb-md-0">
							<!-- <div class="best-value">Best Value</div> -->
							<div class="card-header bg-transparent">
								<h5 class="card-title text-muted text-center">{{$subscription_plan->name}}</h5>
								<span class="plan-type text-uppercase">
									<i class="fas fa-user"></i> {{$subscription_plan->max_team_member ?: 'Unlimited'}} User
								</span>
								<h6 class="document-type text-center mb-0">Fill and edit documents</h6>
							</div>
							<div class="card-body text-left px-0 pb-0">
								<div class="plan-ul">
									<ul class="fa-ul">
										{!! $subscription_plan->feature_list !!}
									</ul>
									<!-- <ul class="fa-ul">
										<li><span class="fa-li"><i class="fas fa-check"></i></span>Edit, Fill, draw, print, save, or fax </li>
										<li><span class="fa-li"><i class="fas fa-check"></i></span>Convert PDF's to edittable word documents</li>
										<li><span class="fa-li"><i class="fas fa-check"></i></span>Erase, highlight & re-write PDF's</li>
										<li><span class="fa-li"><i class="fas fa-check"></i></span>Access documents from anywhere</li>
										<li><span class="fa-li"><i class="fas fa-check"></i></span>highlight & annotate documents</li>
										<li><span class="fa-li"><i class="fas fa-check"></i></span>Customer support within a day</li>
									</ul> -->
								</div>

								<!-- <div class="view-more">
									<a href="#">View More</a>
								</div> -->
								@if(!empty($subscription_plan->yearly_amount))
								<div class="plan-price yearly-element-{{$subscription_plan->id}}">
									<h2><sup>{{$currency_symbol}}</sup><span>{{$subscription_plan->yearly_amount}}</span></h2>
									<h3>From {{$currency_symbol}}{{round($subscription_plan->yearly_amount/12,2)}}<span>(per month)</span></h3>
									<div class="annual-commitment">Annual Commitment</div>
								</div>
								@endif
								@if(!empty($subscription_plan->monthly_amount))
								<div class="plan-price monthly-element-{{$subscription_plan->id}} d-none">
									<h2><sup>{{$currency_symbol}}</sup><span>{{$subscription_plan->monthly_amount}}</span></h2>
									<h3>&nbsp;<span>&nbsp;</span></h3>
									<div class="annual-commitment">Monthly Commitment</div>
								</div>
								@endif
								<div class="choose-payment-schedule">
									<div class="payment-schedule">Choose Payment Schedule</div>
									<div class="select-plan">
										<select name="subscription_plan_type" class="form-control my-dropdown subscription_plan_type">
											@foreach($subscription_plan_type_arr as $key => $subscription_plan_type)
											@php $type = strtolower($subscription_plan_type)."_amount"; @endphp
											@if(!empty($subscription_plan->$type))
											<option value="{{$key}}" data-id='{{$subscription_plan->id}}' data-type='{{strtolower($subscription_plan_type)}}'>
												{{$subscription_plan_type}} Plan
											</option>
											@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="card-footer bg-transparent">
								{!! Form::submit('Annual '.$subscription_plan->name.' Plan',['class'=>'btn btn-block btn-default text-uppercase yearly-element-'.$subscription_plan->id]) !!}
								{!! Form::submit('Monthly '.$subscription_plan->name.' Plan',['class'=>'btn btn-block btn-default text-uppercase d-none monthly-element-'.$subscription_plan->id]) !!}
							</div>
						</div>
						{{ Form::close() }}
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>

<section class="signnow-section online-solution mb-0">
	<div class="container">
		<div class="signnow-part shadow-none">
			<div class="row">
				<div class="col-md-12 signnow-heading text-center">
					<h3>The <span class="green-color">all-in-one</span> online solution</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="sign-card">
						<div class="sign-card-img">
							<img src="{{ asset('public/front/images/clock.svg') }}">
						</div>
						<h3>Save time editing PDFs online</h3>
						<p>Type text anywhere on PDFs, edit original content, images, graphics, and black out confidential details.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="sign-card">
						<div class="sign-card-img">
							<img src="{{ asset('public/front/images/e-signature.svg') }}">
						</div>
						<h3>Close deals faster with e‑signatures</h3>
						<p>Create complex e‑signature workflows in seconds on any desktop or mobile device and get instant notifications.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="sign-card">
						<div class="sign-card-img">
							<img src="{{ asset('public/front/images/client-feedback.svg') }}">
						</div>
						<h3>Collect private client feedback</h3>
						<p>Turn documents into online fillable forms. Host them on a website or collect client feedback via a shared link.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="sign-card">
						<div class="sign-card-img">
							<img src="{{ asset('public/front/images/transfer-data.svg') }}">
						</div>
						<h3>Transfer & extract data in a click</h3>
						<p>Automatically merge spreadsheet data with multiple documents. Export data from client forms into a spreadsheet.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="sign-card">
						<div class="sign-card-img">
							<img src="{{ asset('public/front/images/find-document.svg') }}">
						</div>
						<h3>Find any document you need</h3>
						<p>Search for the right document in an online library of over 25 million fillable documents right from your account.</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="sign-card">
						<div class="sign-card-img">
							<img src="{{ asset('public/front/images/box-integration.svg') }}">
						</div>
						<h3>Out of the box integrations</h3>
						<p>Integrate PDF writer’s all-in-one editor, form builder & e‑signatures with CRMs, G Suite and other cloud platforms.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="faq-section-part">
	<img class="faq-dots" src="{{ asset('public/front/images/faq-dots.svg') }}">
	<div class="container">
		<div class="faq-width">
			<div class="row">
				<div class="col-md-12 signnow-heading text-center mb-4">
					<h3>Questions <span class="green-color">& Answers</span></h3>
					<p>Below is a list of the most common customer questions. If you can’t find an answer to your question, please don’t hesitate to reach out to us.</p>
				</div>
				<div class="col-md-12">
					<ul class="faq-accordion">
						<li>
							<a>What if I want to cancel my account during the trual period?</a>
							<p>You can buy a PDF writer subscription online using your credit card. If credit card payment is not available, contact our support team.</p>
						</li>
						<li>
							<a>What if I want to cancel my account during the trual period?</a>
							<p>You can buy a PDF writer subscription online using your credit card. If credit card payment is not available, contact our support team.</p>
						</li>
						<li>
							<a>Do i have to use a credit card or can i pay by check?</a>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit, ipsum, fuga, in, obcaecati magni ullam nobis voluptas fugiat tenetur voluptatum quas tempora maxime rerum neque deserunt suscipit provident cumque
								et mollitia ex aspernatur porro minus sapiente voluptatibus eos at perferendis repellat odit aliquid harum molestias ratione pariatur adipisci. Aliquid, iure.</p>
						</li>
						<li>
							<a>What if I want to cancel my account during the trual period?</a>
							<p>You can buy a PDF writer subscription online using your credit card. If credit card payment is not available, contact our support team.</p>
						</li>
						<li>
							<a>What if I want to cancel my account during the trual period?</a>
							<p>You can buy a PDF writer subscription online using your credit card. If credit card payment is not available, contact our support team.</p>
						</li>
						<li>
							<a>Do i have to use a credit card or can i pay by check?</a>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit, ipsum, fuga, in, obcaecati magni ullam nobis voluptas fugiat tenetur voluptatum quas tempora maxime rerum neque deserunt suscipit provident cumque
								et mollitia ex aspernatur porro minus sapiente voluptatibus eos at perferendis repellat odit aliquid harum molestias ratione pariatur adipisci. Aliquid, iure.</p>
						</li>
					</ul>
					<!-- / faq-accordion -->
				</div>
			</div>
		</div>
	</div>
</section>

@include('front.blocks.solve-pdf-problems')
@endsection
@section('additionaljs')
<script type="text/javascript">
	$(document).on('change', '.subscription_plan_type', function(e) {
		e.preventDefault();
		var plan_id = $('option:selected', this).attr('data-id'); //$(this).attr('data-id');
		var plan_type = $('option:selected', this).attr('data-type'); //$(this).attr('data-type');
		var current_plan = ((plan_type == 'yearly') ? 'monthly' : 'yearly');
		var target_plan = plan_type;
		$('.' + target_plan + '-element-' + plan_id).removeClass('d-none');
		$('.' + current_plan + '-element-' + plan_id).addClass('d-none');
	})
</script>
@append