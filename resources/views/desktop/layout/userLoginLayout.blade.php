@extends('layout.userLayout')
@section('content')
<div class="container" style="margin-bottom: 40px;">
	<div class="col-md-3 col-sm-3 blog-sidebar">
		<!-- BEGIN MENU -->
		<div class="panel">
			<div class="header-panel">
				<h4>{{ Auth::guard('web_users')->user()->name }}</h4>
				<span>{{ Auth::guard('web_users')->user()->email }}</span>
				<hr/>
				<span style="font-size: 16px; font-weight: bold;">TJ Point</span>
				<span style="font-size: 16px;" class="pull-right">{{ Session::get("total_point") }}</span>
			</div>
			<div class="body-panel">
				<ul class="nav">
					<li><a href="{{ url('/profile') }}"><i class="fa fa-user"></i> My Profile</a></li>
					<li><a href="{{ url('/booking') }}"><i class="fa fa-shopping-cart"></i> My Booking</a></li>
					<li><a href="{{ url('/point') }}"><i class="fa fa-file-powerpoint-o"></i> My Points</a></li>
					<li><a href="javascript:;"><i class="fa fa-newspaper-o"></i> My Reviews</a></li>
					<li><a href="javascript:;"><i class="fa fa-key"></i> Change Password</a></li>
					<li><a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
				</ul>
			</div>
		</div>
		<!-- MENU END -->
	</div>
	<div class="col-md-9 col-sm-9 blog-posts">
		@yield('content_login')
	</div>
</div>
@endsection