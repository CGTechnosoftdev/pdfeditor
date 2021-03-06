<header class="main-header">
	<!-- Logo -->
	<a href="{{ route('dashboard') }}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>{{ config('app.short_name') }}</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>{{ config('app.name') }}</b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ Auth::user()->profile_picture_url }}" class="user-image" alt="{{ Auth::user()->first_name.' '.Auth::user()->last_name }} Image">
						<span class="hidden-xs">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="{{ Auth::user()->profile_picture_url }}" class="img-circle" alt="{{ Auth::user()->first_name.' '.Auth::user()->last_name }} Image">

							<p>
								{{ Auth::user()->first_name.' '.Auth::user()->last_name }}
								<!-- <small>Member since Nov. 2012</small> -->
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
									Sign out
								</a>
							</div>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>