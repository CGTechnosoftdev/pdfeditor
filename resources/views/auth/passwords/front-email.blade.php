@extends('layouts.admin-login')

@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
    <div class="login-logo">
        <a href="#"><b>{{ config('app.name') }}</b></a>
    </div>
        <p class="login-box-msg">Front Forgot Pasword</p>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @if($errors->any())
              <div class="alert alert-danger">
               
                @foreach($errors->all() as $error)
                  {{$error}}
                @endforeach
            
              </div>
           @endif
        <form method="POST" action="{{ route('front.resetpassword.email') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success  btn-block btn-flat"> {{ __('Submit') }}</button>
                </div>
                <div class="col-md-8 text-right">
                    <a class="btn btn-link" href="{{ route('front.login') }}">
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
