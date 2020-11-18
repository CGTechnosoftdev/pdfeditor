<form id="Menu1" class="login-form">
                                    <div class="d-table">
                                        <div class="d-table-cell align-middle">
                                            <div class="heading">
                                                <h3>Log in</h3>
                                                <p>Please enter your credential to continue</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 input-group mb-3">
                                                    <label class="w-100" for="email-address">Email address</label>
                                                    <input id="email-address" type="text" class="form-control email" placeholder="Email address">
                                                </div>
                                                <div class="col-md-12 input-group mb-3">
                                                    <label class="w-100" for="password">Password</label>
                                                    <input id="password" type="text" class="form-control password" placeholder="Password">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="d-flex w-100 mb-3 justify-content-between">
                                                        <div class="custom-control custom-checkbox mr-sm-2">
                                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                                            <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                                        </div>
                                                        <div>
                                                            <a href="#forgotpassword" onclick="toggleVisibility('Menu3');" class="forgot"> Forgot Password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="#login" onclick="toggleVisibility('Menu1');" class="w-100 btn btn-secondary">Login</a>
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

                                </form>