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
				<div class="col-md-6">
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
									<label for="first_name" class="control-label text-left col-sm-6 required">Last Name</label>
									<div class="col-sm-6">
										{{ $user->last_name }}
									</div>
								</div>
								<div class="form-group col-md-12">
									<label for="first_name" class="control-label text-left col-sm-6 required">Role</label>
									<div class="col-sm-6">
										{{ $user->role_name }}
									</div>
								</div>
								<div class="form-group col-md-12">
									<label for="first_name" class="control-label text-left col-sm-6 required">Email</label>
									<div class="col-sm-6">
										{{ $user->email }}
									</div>
								</div>
								<div class="form-group col-md-12">
									<label for="first_name" class="control-label text-left col-sm-6 required">Gender</label>
									<div class="col-sm-6">
										{{ $user->gender_name }}
									</div>
								</div>
								<div class="form-group col-md-12">
									<label for="first_name" class="control-label text-left col-sm-6 required">Phone Number</label>
									<div class="col-sm-6">
										{{ $user->contact_number }}
									</div>
								</div>
								<div class="form-group col-md-12">
									<label for="first_name" class="control-label text-left col-sm-6 required">Status</label>
									<div class="col-sm-6">
										{{ $user->status_name }}
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-lg-12 col-md-12">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#notes-modal">
								Add Note
							</button>
							<button class="btn btn-success">Billing History</button>
							<button class="btn btn-success">Update Plan</button>
							<a href="{{route('front.login-as-user',$user->id)}}" target="_blank" class="btn btn-success">
								Login as User
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-xs-12 col-lg-12 col-md-12">
						<h4>Recent Notes</h4>
						@if(!empty($user->notes->toArray()))
						<ul>
							@foreach($user->notes as $user_note)
							<li>
								<div>{{ changeDateTimeFormat($user_note->created_at) }}</div>
								<div>{{ $user_note->note }}</div>
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
	</div>
</section>
<div class="modal fade" id="notes-modal" tabindex="-1" role="dialog" aria-labelledby="notes-modal-label" aria-hidden="true">
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
							<label for="note" class="control-label text-left col-sm-2 required">
								Note<span class="required-label">*</span>
							</label>
							<div class="col-sm-10">
								{{ Form::textarea('note',null,['placeholder'=>'Notes','class'=>"form-control",'id' => "note",'rows'=>4]) }}
							</div>
						</div>
						<br>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
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
{!! JsValidator::formRequest('App\Http\Requests\UserNoteFormRequest') !!}
<script>
	$(document).ready(function($) {

	});
</script>
@endsection