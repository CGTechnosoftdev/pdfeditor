{{ Form::open(['route' => 'front.user.registration.save','method'=>'post','class'=>'login-form display_none','id' => 'user_registration_id','enctype'=>"multipart/form-data"]) }}
{{ Form::hidden("_token", csrf_token())}}
<div class="d-table">
    <div class="d-table-cell align-middle">
        <div class="heading">
            <h3>Register</h3>
            <p>Please enter the following details</p>
        </div>

        <div class="row">
            <div class="col-md-12 input-group mb-3">
                <label class="w-100" for="email-address">Email address</label>
                <!--<input id="email-address" type="text" class="form-control email" placeholder="Email address"> -->
                {{ Form::text('email',null,array('placeholder'=>'Email address','class'=>"form-control email",'id' => "email-address"))}}
                <span class="required-value text-danger" id="email-error"></span>
            </div>
            <div class="col-md-12 input-group mb-3">
                <label class="w-100" for="password">Password</label>
                <!--<input id="password" type="text" class="form-control password" placeholder="Password">-->
                {{ Form::password('password', ['class' => 'form-control password','placeholder' => 'Password','id'=>'password' ]) }}
                <span class="required-value"><i class="fas fa-lock"></i> 6 Character minimum with no space</span>
                <span class="text-danger" id="password-error"></span>
            </div>
            <div class="col-sm-6">
                <a href="#" id="newregisterid" class="w-100 btn btn-secondary">Register</a>
            </div>
            <div class="col-sm-6">
                <a href="#login" onclick="toggleVisibility('user_login_form_id');" class="w-100 btn btn-outline-secondary">Login</a>
            </div>
            <div class="col-md-12 mt-3">
                <div class="login-terms">
                    <p>By clicking Login in, you agree to the <a href="#">Terms of service</a> and <a href="#">Privacy Policy</a>, Including receipt of emails from us about our service.</p>
                </div>
            </div>
        </div>

    </div>
</div>



@include('front.partials.register-with-social')

{{ Form::close() }}