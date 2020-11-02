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
				<div class="box-header">
					@include('admin.partials.add-new-button')
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<!-- begin:: Content -->
					<input type="hidden" name="top_id" id="top_id" value="{{$top_id}}" />
					@include('admin.faq.table')
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
