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
				<!-- /.row -->

				<div class="col-xs-12 col-lg-10 col-md-9">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="first_name" class="control-label text-left col-sm-3 required">Name</label>
							<div class="col-sm-9">
								{{ $subscription_plan->name }}
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="first_name" class="control-label text-left col-sm-3 required">Yearly Amount</label>
							<div class="col-sm-9">
								{{ myCurrencyFormat($subscription_plan->yearly_amount) }}
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="first_name" class="control-label text-left col-sm-3 required">Monthly Amount</label>
							<div class="col-sm-9">
								{{ myCurrencyFormat($subscription_plan->monthly_amount) }}
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="first_name" class="control-label text-left col-sm-3 required">Discount Percent</label>
							<div class="col-sm-9">
								{{ $subscription_plan->discount_percent }}
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="first_name" class="control-label text-left col-sm-3 required">Max Team Member</label>
							<div class="col-sm-9">
								{{ $subscription_plan->max_team_member }}
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="first_name" class="control-label text-left col-sm-3 required">Description</label>
							<div class="col-sm-9">
								{!! $subscription_plan->description !!}
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="first_name" class="control-label text-left col-sm-3 required">Feature list</label>
							<div class="col-sm-9">
								{!! $subscription_plan->feature_list !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>
<!-- /.content -->
@endsection