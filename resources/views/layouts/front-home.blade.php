<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{ config('general_settings.site_title') ?? config('app.name', 'Laravel') }} | @yield('title')</title>

	@include('front.partials.commoncss')
	@yield('additionalcss')
</head>

<body class="dashboard3 sidebar-mini">
	<div class="dashboard3-wrapper">
		@include('front.partials.header')
		@yield('content')
		@include('front.partials.footer')
		@include('front.partials.commonjs')
		@yield('additionaljs')
	</div>
</body>

</html>