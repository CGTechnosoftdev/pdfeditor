@extends('layouts.admin-login')

@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
    <div class="login-logo">
        <a href="#"><b>{{ config('app.name') }}</b></a>
    </div>
        <p class="login-box-msg">Forgot Pasword</p>
        <form method="POST" action="{{ route('front.resetpassword.save') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label for="email" class="col-form-label">{{ __('E-Mail') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email"  value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
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
                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }} <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{ config('constant.PASSWORD_REGEX_INSTRUCTION') }}"></i></label>
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
                    <div class="form-group has-feedback">
                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success  btn-block btn-flat"> {{ __('Reset Password') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        
    </div> 
    <!-- /.login-box-body -->
</div>
@endsection
