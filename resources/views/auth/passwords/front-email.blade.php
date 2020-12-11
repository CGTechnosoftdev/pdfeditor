<!--<form id="Menu3" class="login-form" style="display: none;"> -->
{{ Form::open(['route' => 'front.resetpassword.email','method'=>'post','class'=>'login-form ','id' => 'forgotpasswordfrm_id','enctype'=>"multipart/form-data"]) }}    
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">   
                                    <div class="d-table">
                                        <div class="d-table-cell align-middle">
                                            <div class="heading">
                                                <h3>Forgot Password</h3>
                                                <p>Please enter email address</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 input-group mb-3">
                                                    <label class="w-100" for="email-address">Email address</label>
                                                    <!--<input id="email-address" type="text" class="form-control email" placeholder="Email address"> -->
                                                    {{ Form::text('email',null,array('placeholder'=>'Email address','class'=>"form-control email",'id' => 'email-address'))}}                                                    
                                                    <strong class="required-value text-danger" id="email-error" ></strong>
                                                    

                                                </div>
                                                <div class="col-sm-6">
                                                    <a  href="#" class="w-100 btn btn-secondary" id="forgot_password_submit_id">Submit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
@include('front.partials.register-with-social')                                   
{{ Form::close() }}