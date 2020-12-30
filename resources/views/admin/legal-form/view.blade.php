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
				<div class="col-xs-12 col-lg-10 col-md-9">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="name" class="control-label text-left col-sm-3 required">Name</label>
							<div class="col-sm-9">
								{{ $legal_form->name }}
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="form" class="control-label text-left col-sm-3 required">Form</label>
							<div class="col-sm-9">
								<a href="{{$legal_form->form_url}}" target="_new" title="Form">
									<i class="fa fa-file-pdf-o"></i>
								</a>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="keywords" class="control-label text-left col-sm-3 required">Keywords</label>
							<div class="col-sm-9">
								{{ $legal_form->keywords }}
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="description" class="control-label text-left col-sm-3 required">Description</label>
							<div class="col-sm-9">
								{{ $legal_form->description }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>
<!-- /.content -->
@endsection