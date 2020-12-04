<header class="navigation-wrap start-header white-bg-nav start-style">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-md navbar-light">

                    <a class="navbar-brand" href="" target="_blank"><img src="{{asset('public/front/images/logo-green.png')}}" alt=""></a>
                    <button type="button" id="sidebarCollapse" class="btn text-sidebar bg-turbo-yellow">
                        <i class="fas fa-align-left"></i>
                        <span></span>
                    </button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @include('front.partials.user-account-header-nav')
                        <!--<ul class="navbar-nav ml-auto">
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
                             </ul>-->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>