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
						<label for="title" class="control-label text-left col-sm-3 required">Title</label>	
						<div class="col-sm-9">
							{!! $email_template->title !!}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="subject" class="control-label text-left col-sm-3 required">Subject</label>	
						<div class="col-sm-9">
							{!! $email_template->subject !!}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="place_holders" class="control-label text-left col-sm-3 required">Email Place Holders <br> <small> (These place holders can be used in content)</small></label>	
						<div class="col-sm-9">
							{!! $email_template->place_holders !!}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="content" class="control-label text-left col-sm-3 required">Content</label>	
						<div class="col-sm-9">
							{!! $email_template->content !!}
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
@endsection