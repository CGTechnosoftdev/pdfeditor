@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<section class="content full-content">
	<!-- Info boxes -->
	<div class="box">
		<div class="user-management">
			<div class="user-info">
				<div class="row">
					<!-- /.row -->
					<div class="col-xs-12 col-lg-3 col-md-4">
						<div class="upload-img form-group">
							<div class="img-preview">
								<img id="blah" src="{{ $user->profile_picture_url ?: asset('public/admin/dist/img/camera-account.svg') }}" alt="{{ $user->full_name.' Image'}}" />
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-lg-9 col-md-8">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="first_name" class="control-label text-left col-sm-6 required">First Name</label>
								<div class="col-sm-6">
									{{ $user->first_name }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="last_name" class="control-label text-left col-sm-6 required">Last Name</label>
								<div class="col-sm-6">
									{{ $user->last_name }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="role_name" class="control-label text-left col-sm-6 required">Role</label>
								<div class="col-sm-6">
									{{ $user->role_name }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="email" class="control-label text-left col-sm-6 required">Email</label>
								<div class="col-sm-6">
									{{ $user->email }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="gender_name" class="control-label text-left col-sm-6 required">Gender</label>
								<div class="col-sm-6">
									{{ $user->gender_name }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="contact_number" class="control-label text-left col-sm-6 required">Phone Number</label>
								<div class="col-sm-6">
									{{ $user->contact_number }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="subscription_status" class="control-label text-left col-sm-6 required">Subscription Status</label>
								<div class="col-sm-6">
									{{ $user->subscription_status_name }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="plan_name" class="control-label text-left col-sm-6 required">Current Plan</label>
								<div class="col-sm-6">
									{{ $user->plan_name }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="plan_expiry" class="control-label text-left col-sm-6 required">Plan Expiry</label>
								<div class="col-sm-6">
									{{ $user->plan_expiry }}
								</div>
							</div>
							@if(!empty($user->lastSubscriptionDetail))
							<div class="form-group col-md-12">
								<label for="upcoming_renewal_plan" class="control-label text-left col-sm-6 required">Upcoming Renewal Plan</label>
								<div class="col-sm-6">
									{{ $user->getUpcomingRenewalPlan() }}
								</div>
							</div>
							<div class="form-group col-md-12">
								<label for="upcoming_renewal_amount" class="control-label text-left col-sm-6 required">Upcoming Renewal Amount</label>
								<div class="col-sm-6">
									{{ $user->getUpcomingRenewalAmount() }}
								</div>
							</div>
							@endif
							<div class="form-group col-md-12">
								<label for="status_name" class="control-label text-left col-sm-6 required">Status</label>
								<div class="col-sm-6">
									{{ $user->status_name }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-9 col-md-8 col-lg-offset-3 col-md-offset-4">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#notes-modal">
							Add Note
						</button>
						<a href="{{route('user.billing-history',$user->id)}}">
							<button class="btn btn-success">Billing History</button>
						</a>
						@if(!empty($user->lastSubscriptionDetail))
						<button class="btn btn-success" data-toggle="modal" data-target="#update-plan-modal">
							Update Plan
						</button>
						@endif
						<a href="{{route('front.login-as-user',$user->id)}}" target="_blank">
							<button class="btn btn-success">Login as User</button>

						</a>
					</div>
				</div>
			</div>
			<div class="recent-notes">
				<div class="notes-heading">
					<h4>Recent Notes</h4>
				</div>
				<div class="notes-content">
					@if(!empty($user->notes->toArray()))
					<ul>
						@foreach($user->notes as $user_note)
						<li>
							<div class="date-time">{{ changeDateTimeFormat($user_note->created_at) }}</div>
							<p>{{ $user_note->note }}</p>
						</li>
						@endforeach
					</ul>
					@else
					<h5>No notes added</h5>
					@endif
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
<!-- Modal -->
<div id="update-plan-modal" class="modal fade new-modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Renewal Plan</h4>
			</div>
			<div class="modal-body">
				{{ Form::open(['route' => ['user.update-plan',$user->id],'method'=>'post','class'=>'form-horizontal','id' => 'plan-form']) }}
				{{ Form::hidden("_token", csrf_token())}}
				<div class="form-group">
					<label class="control-label col-sm-4" for="plan_name">Plan Name<span class="required-label">*</span></label>
					<div class="col-sm-8">
						{!! Form::select('plan_name',$subscription_plan_arr, $user->subscription_plan_id, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="play_type">Plan Type<span class="required-label">*</span></label>
					<div class="col-sm-8">
						{!! Form::select('play_type',$plan_type_arr, $user->subscription_plan_type, ['class'=>'form-control']) !!}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="plan_amount">Plan Amount<span class="required-label">*</span></label>
					<div class="col-sm-8">
						{{ Form::number('plan_amount',$user->subscription_plan_amount,['class'=>"form-control",'min'=>0, 'step'=>0.50])}}
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="date">Renewal Date<span class="required-label">*</span></label>
					<div class="col-sm-8">
						<div class="input-group">
							{{ Form::text('renewal_date',$user->plan_expiry,['class'=>"form-control datepicker"]) }}
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="submit" class="btn btn-success">Submit</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="notes-modal" class="modal fade new-modal" role="dialog">
	<div class="modal-dialog" role="document" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">User Note</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 col-lg-12 col-md-12">
						{{ Form::open(['route' => ['user.save-note',$user->id],'method'=>'post','class'=>'form-horizontal','id' => 'note-form']) }}
						{{ Form::hidden("_token", csrf_token())}}
						<div class="form-group">
							<label class="control-label col-sm-4" for="note">Note<span class="required-label">*</span></label>
							<div class="col-sm-8">
								{{ Form::textarea('note',null,['placeholder'=>'Notes','class'=>"form-control",'id' => "note",'rows'=>4]) }}
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-8">
								{!! Form::submit('Submit',['class'=>'btn btn-success']) !!}
								<button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">
									Cancel
								</button>
							</div>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.content -->
@endsection
@section('additionaljs')
{!! JsValidator::formRequest('App\Http\Requests\UserNoteFormRequest','#note-form') !!}
{!! JsValidator::formRequest('App\Http\Requests\UserPlanUpdateFormRequest','#plan-form') !!}
<script>
	$('.datepicker').datepicker({
		autoclose: true,
		format: "{{ (config('custom_config.js_date_format_arr')[config('general_settings.date_format')]) }}",
		startDate: "+1d",
	});
	$(document).ready(function($) {

	});
</script>
@endsection