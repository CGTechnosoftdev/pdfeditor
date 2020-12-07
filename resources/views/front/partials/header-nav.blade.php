<ul class="navbar-nav m-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">For Business</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Developers</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">Support</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.pricing') }}">Pricing</a>
    </li>
    @if(Auth::user())
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.dashboard') }}">Dashboard</a>
    </li>
    @endif

</ul>
<ul class="navbar-nav ml-auto login_signup">
    @if(!Auth::user())
    <li class="nav-item">
        <a class="nav-link login" href="#" data-remote="myRemoteURL.do" id="login_btn_id">Log in</a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link login" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" data-remote="myRemoteURL.do">Logout</a>
        <form id="logout-form" action="{{ route('front.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    @endif
    @if(!Auth::user() || empty(Auth::user()->lastSubscriptionDetail))
    <li class="nav-item">
        <a class="nav-link start-trial" href="{{ route('front.pricing') }}">Start Free Trial</a>
    </li>
    @endif
</ul>