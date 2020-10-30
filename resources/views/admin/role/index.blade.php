@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<div class="row">
		<div class="col-md-12">
			<!-- <div class="head-title">
				<h1 class="pull-left">Title 1</h1>
				<a class="btn btn-success pull-right" href="">Add</a>
			</div> -->
		</div>
		<div class="col-xs-12">
			<div class="box">
				<!-- <div class="box-header">
					@include('admin.partials.add-new-button')
				</div> -->
				<!-- /.box-header -->
				<div class="box-body">
					<!-- begin:: Content -->
					@include('admin.datatable.table')
					<!-- end:: Content -->

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>

	</div>
	<!-- /.row -->

</section>
<!-- /.content -->

@endsection
