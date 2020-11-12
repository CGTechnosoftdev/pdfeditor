@extends('layouts.admin-login')

@section('content')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
    <div class="login-logo">
        <a href="#"><b>{{ config('app.name') }}</b></a>
    </div>
        <p class="login-box-msg">Front Forgot Pasword</p>
        <div class="alert alert-success alert-block invisible" id="success_msg_id_container"> 			
 			<strong id="success_msg_id"></strong>
 			<button type="button" class="close" data-dismiss="alert">×</button>
 		</div>
        <form method="POST" action="{{ route('front.resetpassword.email') }}" id="forgotpasswordfrm_id">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">     
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group has-feedback">
                        <label for="email" class="col-form-label">{{ __('Email Address') }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        
                        <span class="invalid-feedback" role="alert">
                            <strong id="email-error-txt" ></strong>
                        </span>
                        
                    </div>
                </div>
                
                <div class="col-md-8 text-right">
                   <!-- <a class="btn btn-link" href="{{ route('front.login') }}">
                        {{ __('Login Now') }}
                    </a> -->
                </div>
                <!-- /.col -->
            </div>
        </form>
        
    </div> 
    <!-- /.login-box-body -->
</div>
@endsection
