@extends('layouts.admin-login')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<a href="#"><b>{{ config('app.name') }}</b></a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Admin Login</p>
		<form method="POST" action="{{ route('login') }}">
			@csrf
			<div class="row">
				<div class="col-md-12">
					<div class="form-group has-feedback">
						<label for="email" class="col-form-label">{{ __('E-Mail') }}</label>
						<input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group has-feedback">
						<label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
						<input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
				</div>
				<div class="col-md-12">
					<div class="checkbox">
						<label>
							<input type="checkbox"> Remember Me
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-md-4">
					<button type="submit" class="btn btn-success  btn-block btn-flat">{{ __('Login') }}</button>
				</div>
				<div class="col-md-8 text-right">
					<a class="btn btn-link" href="{{ route('password.request') }}">
						{{ __('Forgot Your Password?') }}
					</a>
				</div>
				<!-- /.col -->
			</div>
		</form>
		
	</div> 
	<!-- /.login-box-body -->
</div>
@endsection
