@extends('layouts.admin-login')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>{{ config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Reset Password</p>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
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
                <div class="col-md-8">
                    <button type="submit" class="btn btn-success  btn-block btn-flat"> {{ __('Send Password Reset Link') }}</button>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('Login Now') }}
                    </a>
                </div>
                <!-- /.col -->
            </div>
        </form>
        
    </div> 
    <!-- /.login-box-body -->
</div>
@endsection
