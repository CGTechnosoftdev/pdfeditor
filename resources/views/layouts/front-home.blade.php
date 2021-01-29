<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{ config('general_settings.site_title') ?? config('app.name', 'Laravel') }} | @yield('title')</title>
	<meta name="google-site-verification" content="_Yg97CCJXq5DPPyyVhdFXaJ_x2MVg2k3ILcpQdTJHPk" />
	@include('front.partials.commoncss')
	@yield('additionalcss')
</head>

<body>

	@include('front.partials.header')
	@yield('content')
	@include('front.partials.footer')
	@include('front.partials.commonjs')
	@yield('additionaljs')

</body>

</html>