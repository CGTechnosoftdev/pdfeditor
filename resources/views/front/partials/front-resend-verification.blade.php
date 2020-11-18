<!--<form id="Menu3" class="login-form" style="display: none;"> -->
{{ Form::open(['route' => 'front.resend.verification.account.submit','method'=>'post','class'=>'login-form display_none','id' => 're_send_verification_form_id','enctype'=>"multipart/form-data"]) }}



<div class="d-table">
    <div class="d-table-cell align-middle">
        <div class="heading">
            <h3>Email Verification</h3>
            <p>Please enter email address</p>
        </div>
        <div class="row">
            <div class="col-md-12 input-group mb-3">
                <label class="w-100" for="email-address">Email address</label>
                <!--<input id="email-address" type="text" class="form-control email" placeholder="Email address"> -->
                {{ Form::text('email',null,array('placeholder'=>'Email address','class'=>"form-control email",'id' => 'resend-email-address'))}}
                <strong class="required-value text-danger" id="email-error-txt"></strong>


            </div>
            <div class="col-sm-6">
                <a href="#" class="w-100 btn btn-secondary" id="resend_verificationemailId">Submit</a>
            </div>
        </div>
    </div>
</div>
@include('front.partials.register-with-social')
{{ Form::close() }}