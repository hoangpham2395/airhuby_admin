<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
</a>
<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">
	<ul class="nav navbar-nav">
		<!-- User Account -->
		<li class="dropdown user user-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				@if ((!empty(Auth::user()->user_avatar)) && (file_exists(public_path().Auth::user()->user_avatar)))
				<img src='{{ asset(Auth::user()->user_avatar) }}' class="user-image" alt="Avatar">
				@else 
				<img src="{{ asset('images/no-image.png') }}" class="user-image" alt="Avatar">
				@endif
				<span class="hidden-xs">{{ Auth::user()->user_name }}</span>
			</a>
			<ul class="dropdown-menu">
				<!-- User image -->
				<li class="user-header">
					@if ((!empty(Auth::user()->user_avatar)) && (file_exists(public_path().Auth::user()->user_avatar)))
					<img src='{{ asset(Auth::user()->user_avatar) }}' class="img-circle" alt="Avatar">
					@else 
					<img src="{{ asset('images/no-image.png') }}" class="img-circle" alt="Avatar">
					@endif
					<p>
						{{ Auth::user()->user_name }}
						<small>Airhuby {{ Auth::user()->user_role }}</small>
					</p>
				</li>
				<li class="user-body">
					<div class="text-center">
						<a href="{{ asset('users/'.Auth::user()->user_id.'/change_password') }}">Change password</a>
					</div>
				</li>
			</li>
			<!-- Menu Footer-->
			<li class="user-footer">
				<div class="pull-left">
					<a href='{{ asset("users/".Auth::user()->user_id) }}' class="btn btn-default btn-flat">Profile</a>
				</div>
				<div class="pull-right">
					<a href="{{ asset('logout') }}" class="btn btn-default btn-flat">Sign out</a>
				</div>
			</li>
		</ul>
	</li>
</ul>
</div> <!-- /.navbar right menu -->
