<header class="navigation-wrap start-header start-style">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light">

                        <a class="navbar-brand" href="" target="_blank"><img src="{{ asset('public/front/images/logo.png')}}" alt=""></a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">For Business</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Developers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Features</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Support</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Pricing</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Services</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </div>
                                </li> -->
                            </ul>
                            <ul class="navbar-nav ml-auto login_signup">
                            @if(!Auth::user())
                                <li class="nav-item">
                                    <a class="nav-link login" href="#" data-remote="myRemoteURL.do" data-toggle="modal" data-target="#exampleModal" id="login_btn_id" >Log in</a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a class="nav-link login" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-remote="myRemoteURL.do"  >Logout</a>
                                    <form id="logout-form" action="{{ route('front.logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
                                </li>
                                @endif   
                                <li class="nav-item">
                                    <a class="nav-link start-trial" href="#">Start Free Trial</a>
                                </li>
                            </ul>
                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </header>