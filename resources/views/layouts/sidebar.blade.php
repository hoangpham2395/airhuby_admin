
<!-- sidebar -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      @if ((!empty(Auth::user()->user_avatar)) && (file_exists(public_path().Auth::user()->user_avatar)))
        <img src='{{ asset(Auth::user()->user_avatar) }}' class="img-circle" alt="Avatar">
      @else 
        <img src="{{ asset('images/no-image.png') }}" class="img-circle" alt="Avatar">
      @endif
    </div>
    <div class="pull-left info">
      <p>{{ Auth::user()->user_name }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <!-- <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
        </button>
      </span>
    </div>
  </form> -->
  <!-- /.search form -->
  <!-- sidebar menu -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li>
      <a href="{{ asset('dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-book"></i>
        <span>Books</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="active"><a href="{{ asset('books') }}"><i class="fa fa-th-list"></i> List of Books</a></li>
        <li><a href="{{ asset('books/create') }}"><i class="fa fa-plus"></i> Add new book</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="{{ asset('categories') }}">
        <i class="fa fa-bars"></i>
        <span>Categories</span>
        <!-- <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> -->
      </a>
      <!-- <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-th-list"></i> List of Categories</a></li>
        <li><a href="#"><i class="fa fa-plus"></i> Add new category</a></li>
      </ul> -->
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Users</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href='{{ asset("users") }}'><i class="fa fa-th-list"></i> List of Users</a></li>
        <li><a href='{{ asset("users/create") }}'><i class="fa fa-plus"></i> Add new user</a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="{{ asset('borrows') }}">
        <i class="fa fa-shopping-cart"></i>
        <span>Borrows</span>
      </a>
    </li>
  </ul>
</section>
<!-- /.sidebar -->