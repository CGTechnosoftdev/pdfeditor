@extends('layouts.user-account')
@section("content")
<div class="wrapper">
	@include('front.partials.user-account-sidebar')

	<!-- Page Content  -->
	<div id="content">
		@include('admin.partials.flash-messages')
		<div class="main-title">
			<h2>Dashboard</h2>
		</div>

	</div>
</div>
@endsection