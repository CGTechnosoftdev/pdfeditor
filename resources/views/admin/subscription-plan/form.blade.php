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
					@if(isset($subscription_plan))
					{{ Form::model($subscription_plan,['route' => ['subscription-plan.update',$subscription_plan->id],'method'=>'put','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@else
					{{ Form::open(['route' => 'subscription-plan.store','method'=>'post','class'=>'form-horizontal','enctype'=>"multipart/form-data"]) }}
					@endif
					{!! Form::token() !!}

					<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="control-label text-left col-sm-4 required">Name<span class="required-label">*</span></label>	
						<div class="col-sm-8">
							{{ Form::text('name',old('name'),['placeholder'=>'Enter Name','class'=>"form-control",'id'=>'name',"onKeyup" => "createSlug('#name','#slug')"]) }}
							@if ($errors->has('name'))
							<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
							@endif
						</div>
					</div>			
					<div class="form-group {{ $errors->has('yearly_amount') ? ' has-error' : '' }}">
						<label for="yearly_amount" class="control-label text-left col-sm-4 required">Yearly Amount<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('yearly_amount',old('yearly_amount'),['placeholder'=>'Enter yearly_amount','class'=>"form-control"])}}
							@if ($errors->has('yearly_amount'))
							<span class="help-block"><strong>{{ $errors->first('yearly_amount') }}</strong></span>
							@endif
						</div>
                    </div>
                    <div class="form-group {{ $errors->has('monthly_amount') ? ' has-error' : '' }}">
						<label for="monthly_amount" class="control-label text-left col-sm-4 required">Monthly Amount<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::text('monthly_amount',old('monthly_amount'),['placeholder'=>'Enter Monthly Amount','class'=>"form-control"])}}
							@if ($errors->has('monthly_amount'))
							<span class="help-block"><strong>{{ $errors->first('monthly_amount') }}</strong></span>
							@endif
						</div>
                    </div>
                    <div class="form-group {{ $errors->has('discount_percent') ? ' has-error' : '' }}">
						<label for="discount_percent" class="control-label text-left col-sm-4 required">Discount Percent</label>
						<div class="col-sm-8" >
							{{ Form::text('discount_percent',old('discount_percent'),['placeholder'=>'Enter Discount Percent','class'=>"form-control"])}}
							@if ($errors->has('discount_percent'))
							<span class="help-block"><strong>{{ $errors->first('discount_percent') }}</strong></span>
							@endif
						</div>
                    </div>


                    <div class="form-group {{ $errors->has('max_team_member') ? ' has-error' : '' }}">
						<label for="max_team_member " class="control-label text-left col-sm-4 required">Max Team Member<span class="required-label">*</span></label>
						<div class="col-sm-8" >
							{{ Form::number('max_team_member',old('max_team_member'),['placeholder'=>'Enter Max Team Member','class'=>"form-control"])}}
							@if ($errors->has('max_team_member'))
							<span class="help-block"><strong>{{ $errors->first('max_team_member') }}</strong></span>
							@endif
						</div>
                    </div>
                    

					<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
						<label for="description" class="control-label text-left col-sm-4 required">Description</label>
						<div class="col-sm-8" >
							{{ Form::textarea('description',old('description'),['placeholder'=>'Enter Description','class'=>"form-control"])}}
							@if ($errors->has('description'))
							<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
							@endif
						</div>
                    </div>
                    

					<div class="form-group {{ $errors->has('feature_list') ? ' has-error' : '' }}">
						<label for="feature_list" class="control-label text-left col-sm-4 required">Feature List</label>
						<div class="col-sm-8" >
							{{ Form::textarea('feature_list',old('feature_list'),['placeholder'=>'Enter Feature List','class'=>"form-control"])}}
							@if ($errors->has('feature_list'))
							<span class="help-block"><strong>{{ $errors->first('feature_list') }}</strong></span>
							@endif
						</div>
                    </div>
                    
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							{!! Form::submit((isset($subscription_plan)) ? 'Update' : 'Save',['class'=>'btn btn-success']) !!}
							{!! Html::link(route('subscription-plan.index'),'Cancel',['class'=>'btn btn-default']) !!}
						</div>
					</div>
					{{ Form::close() }}
				</div>
				<div class="col-xs-12 col-lg-6 col-md-3">	
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
{!! JsValidator::formRequest('App\Http\Requests\SubscriptionPlanFormRequest') !!}
@endsection