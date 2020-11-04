@extends('layouts.admin')
@section('title',($title ?? ''))
@section('heading',($heading ?? ''))
@section('breadcrumb',($breadcrumb ?? ''))
@section('content')
<!-- Main content -->
<section class="content">
	<!-- Info boxes -->
	<div class="row"> 
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<!-- begin:: Content -->

					<a class="btn btn-success pull-right" href="{{route('top-100-form.index')}}">Back</a>
					@include('admin.top100form.form.table')
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
