<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	<!-- Styles -->
	<style>
		html, body {
			background-color: #fff;
			color: #636b6f;
			font-family: 'Nunito', sans-serif;
			font-weight: 200;
			height: 100vh;
			margin: 0;
		}

		.full-height {
			height: 100vh;
		}

		.flex-center {
			align-items: center;
			display: flex;
			justify-content: center;
		}

		.position-ref {
			position: relative;
		}

		.top-right {
			position: absolute;
			right: 10px;
			top: 18px;
		}

		.content {
			text-align: center;
		}

		.title {
			font-size: 84px;
		}

		.links > a {
			color: #636b6f;
			padding: 0 25px;
			font-size: 13px;
			font-weight: 600;
			letter-spacing: .1rem;
			text-decoration: none;
			text-transform: uppercase;
		}

		.m-b-md {
			margin-bottom: 30px;
		}
	</style>
</head>
<body>
	<div class="flex-center position-ref full-height">
		@if (Route::has('login'))
		<div class="top-right links">
			@guest
			<a href="{{ route('front.login') }}">Login</a>
			@else
			<a href="{{ route('front.logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
				Logout out
			</a>
			<form id="logout-form" action="{{ route('front.logout') }}" method="POST" style="display: none;">
				@csrf
			</form>
			@endguest
		</div>
		@endif

		<div class="content">
			<div class="title m-b-md">
				{{ config('app.name') }} User Dashboard
			</div>
		</div>
	</div>
</body>
</html>
