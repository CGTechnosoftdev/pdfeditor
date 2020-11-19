{{ Form::open(['route' => 'front.login','method'=>'post','class'=>'login-form','id' => 'user_login_form_id','enctype'=>"multipart/form-data"]) }}
<input type="hidden" name="_token" value="{{csrf_token()}}" />
    <div class="d-table">
        <div class="d-table-cell align-middle">
            <div class="heading">
                <h3>Log in</h3>
                <p>Please enter your credential to continue</p>
            </div>
            <div class="row">
                <div class="col-md-12 input-group mb-3">
                    <label class="w-100" for="email-address">Email address</label>                    
                    {{ Form::text('email',null,array('placeholder'=>'Enter Email','class'=>"form-control email"))}}
                    <span class="required-value text-danger" id="email-error"></span>
                </div>
                <div class="col-md-12 input-group mb-3">
                    <label class="w-100" for="password">Password</label>                    
                    {{ Form::password('password', ['class' => 'form-control password','placeholder' => 'Password ','id'=>'password' ]) }} 
                    <span class="required-value text-danger" id="password-error"></span>
                </div>
                <div class="col-md-12">
                    <div class="d-flex w-100 mb-3 justify-content-between">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            
                            <input class="custom-control-input" id="remember-me" type="checkbox" value="1">
                            <label for="remember-me">Remember Me</label>
                        </div>
                        <div>
                            <a href="#" onclick="toggleVisibility('forgotpasswordfrm_id');" class="forgot"> Forgot Password?</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <a href="#" id="LoginBtnId" class="w-100 btn btn-secondary">{{ __('Login') }}</a>
                
                </div>
                <div class="col-sm-6">
                    <a href="#register" onclick="toggleVisibility('user_registration_id');" class="w-100 btn btn-outline-secondary">Register</a>
                </div>
                <div class="col-md-12">
                    <div class="login-with-phone py-3 text-center">
                        <a href="#"><i class="fas fa-mobile-alt"></i> Login with your phone</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="login-terms">
                        <p>By clicking Login in, you agree to the <a href="#">Terms of service</a> and <a href="#">Privacy Policy</a>, Including receipt of emails from us about our service.</p>
                    </div>
                </div>
            </div>
        </div>
</div>
 @include('front.partials.register-with-social')
 {{ Form::close() }}