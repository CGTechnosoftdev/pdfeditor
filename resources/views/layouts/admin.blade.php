<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	@include('admin.partials.commoncss') 
	@yield('additionalcss')
	<script type="text/javascript">
		var base_url = "{{url('')}}";
		var admin_url = '{!! url("/admin") !!}';
		var csrf_token = "{{csrf_token()}}";
		var blankOption = "<option value=''>{{lang_trans('label.select')}}</option>";
	</script>
</head>
<body class="hold-transition skin-green-light sidebar-mini">
	<div class="wrapper">
		@include('admin.partials.header') 
		<!-- Left side column. contains the logo and sidebar -->
		@include('admin.partials.sidebar')
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<!-- <section class="content-header">
				<h1>
					@yield('heading')
					<small>@yield('sub_heading')</small>
				</h1>
				@yield('breadcrumb')
			</section> -->
			<section class="content-header">
				<div class="head-title">
					<h1 class="pull-left">@yield('heading')</h1>
					@include('admin.partials.back-button')
					@include('admin.partials.add-new-button')
				</div>
			</section>
			<!-- Main content -->
			<section class="content">
				@include('admin.partials.flash-messages')
				<!-- Content Wrapper. Contains page content -->
				@yield('content')
				<!-- /.content-wrapper -->
			</section>
		</div>
		@include('admin.partials.footer')	

	</div>
	<!-- ./wrapper -->
	@include('admin.partials.commonjs') 
	@yield('additionaljs')
	
</body>
</html>

