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
				<div class="col-xs-12 col-lg-2 col-md-3">			
					<div class="upload-img form-group">
						<div class="img-preview">
							<img id="blah" src="{{ $sub_admin->profile_picture_url ?: asset('public/admin/dist/img/camera-account.svg') }}" alt="{{ $sub_admin->full_name.' Image'}}" />
						</div>	
					</div>
				</div>
				<div class="col-xs-12 col-lg-10 col-md-9">	
					<div class="row">
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">First Name</label>	
						<div class="col-sm-9">
							{{ $sub_admin->first_name }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Last Name</label>	
						<div class="col-sm-9">
							{{ $sub_admin->last_name }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Role</label>	
						<div class="col-sm-9">
							{{ $sub_admin->role_name }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Email</label>	
						<div class="col-sm-9">
							{{ $sub_admin->email }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Gender</label>	
						<div class="col-sm-9">
							{{ $sub_admin->gender_name }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Phone Number</label>	
						<div class="col-sm-9">
							{{ $sub_admin->contact_number }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Status</label>	
						<div class="col-sm-9">
							{{ $sub_admin->status_name }}
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
@endsection