@extends('layout.userLayout')
@section('content')
<div class="wrapper">
		<!--=== Header ===-->
		<div class="header">

			

		<!--=== Profile ===-->
		<div class="container content profile">
			<div class="row">






	<!--Left Sidebar-->
				<div class="col-md-3 md-margin-bottom-40">

					<p>&nbsp;</p>

					<ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
						<li class="list-group-item active">
							<a href="{{ url('/profile') }}"><i class="fa fa-user"></i> My Profile</a>
						</li>
						<li class="list-group-item">
							<a href="{{ url('/booking') }}"><i class="fa fa-group"></i> My Booking</a>
						</li>
						<li class="list-group-item">
							<a href="{{ url('/point') }}"><i class="fa fa-cubes"></i> My Points</a>
						</li>
						<li class="list-group-item">
							<a href="{{ url('/userreview') }}"><i class="fa fa-comments"></i> My Reviews</a>
						</li>
						<li class="list-group-item">
							<a href="{{ url('/logout') }}"><i class="fa fa-history"></i> Logout</a>
						</li>
					</ul>

					

					<div class="margin-bottom-50"></div>

					
				</div>
				<!--End Left Sidebar-->




	<div class="col-md-9">
		@yield('content_login')
	</div>
</div>
</div>
</div>
</div>
@endsection