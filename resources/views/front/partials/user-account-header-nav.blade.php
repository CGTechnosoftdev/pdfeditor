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
        <a class="nav-link" href="#">Features</a>
    </li>

    @if(!Auth::user())
    <li class="nav-item">
        <a class="nav-link login" href="#" data-remote="myRemoteURL.do" id="login_btn_id">Log in</a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('front.subscription-payment')}}">Subscription & Payment</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <a class="dropdown-item" href="#">Another action</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-remote="myRemoteURL.do">Logout</a>
        <form id="logout-form" action="{{ route('front.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    @endif
    @if(!Auth::user() || empty(Auth::user()->lastSubscriptionDetail))
    <li class="nav-item">
        <a class="nav-link " href="{{ route('front.pricing') }}">Start Free Trial</a>
    </li>
    @endif


    <li class="nav-item more">
        <a class="nav-link" href="#"><i class="fas fa-th-large"></i></a>
    </li>
    <li class="nav-item notifications">
        <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
    </li>
    <li class="dropdown user user-menu">
        <a href="##" class="dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
            <span><img src="{{asset('public/admin/dist/img/avatar.png')}}" class="user-image" alt="PDFWriter Admin Image"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <a class="dropdown-item" href="#">Another action</a>
        </div>
    </li>
</ul>