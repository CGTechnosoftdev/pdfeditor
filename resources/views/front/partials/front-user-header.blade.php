<header class="navigation-wrap start-header white-bg-nav start-style">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light">
                    <button type="button" id="sidebarCollapse" class="btn text-sidebar bg-turbo-yellow sidebar-toggle" data-toggle="push-menu" role="button" style="display: none;">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>

                    <a class="navbar-brand text-md-left" href="{{ route('front.home') }}" target="_blank"><img src="{{ asset('public/front/images/logo.png') }}" alt=""></a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Docs</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">For Business</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Developers</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('front.dashboard')}}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('front.subscription-payment') }}">
                                        Subscription Payment
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item more">
                                <a class="nav-link" href="#"><i class="fas fa-th-large"></i></a>
                            </li>
                            <li class="nav-item notifications">
                                <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                            </li>
                            <li class="dropdown user user-menu">
                                <a href="##" class="dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                    <span><img src="{{Auth::user()->profile_picture_url}}" class="user-image" alt="PDFWriter Admin Image"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                </div>
                            </li>
                        </ul>
                        <!-- <ul class="navbar-nav ml-auto">
                                    <li class="dropdown user user-menu">
                                        <a href="##" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span><img src="../public/admin/dist/img/avatar.png" class="user-image" alt="PDFWriter Admin Image"></span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                        </div>
                                    </li>
                                </ul> -->
                    </div>

                </nav>
            </div>
        </div>
    </div>
</header>