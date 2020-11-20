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
						<label for="name" class="control-label text-left col-sm-3 required">Name</label>	
						<div class="col-sm-9">
							{{ $top_100_form->name }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Slug</label>	
						<div class="col-sm-9">
							{{ $top_100_form->slug }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Relevent Keywords</label>	
						<div class="col-sm-9">
							{{ $top_100_form->relevent_keywords }}
						</div>
					</div>
					<div class="form-group col-md-12">
						<label for="first_name" class="control-label text-left col-sm-3 required">Description</label>	
						<div class="col-sm-9">
							{!! $top_100_form->description !!}
						</div>
					</div>
					
				</div>			
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
@endsection