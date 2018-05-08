<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Airhuby | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Logo -->
  <link rel="shortcut icon" href="{{ asset('images/logo_short_red.png') }}">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
  <!-- Jasny Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/css/jasny-bootstrap.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assets/css/skins/skin-red.min.css') }}">

</head>
<body class="hold-transition skin-red sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset('images/logo_short_white.png') }}" height="30px" width="30px" alt="A"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ asset('images/logo_long_white.png') }}" height="30px" width="110px" alt="Airhuby"></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      @include('layouts.navbar')
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    @include('layouts.sidebar')
  </aside>

  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('content-header')
        <small>@yield('content-header-sm')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-@yield('content-header-fa')"></i> @yield('content-header')</a></li>
        <li class="active"><i class="fa fa-@yield('content-header-fa-sm')"></i> @yield('content-header-sm')</li>
      </ol>
    </section>

    <!-- Main content body-->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.main content -->
  
  <!-- Footer -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    Copyright &copy; 2018 <strong><a href="https://airhuby.com/"><img src="{{ asset('images/logo_long_red.png') }}" width="68px" height="20px"></a></strong>. 
  </footer>
  <!-- /.footer -->

</div>
<!-- ./wrapper -->

<!-- jQuery 3.2.1 -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- Jasny Bootstrap -->
<script src="{{ asset('assets/js/jasny-bootstrap.min.js') }}"></script>
<!-- App -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<!-- dashboard (v2) -->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<!-- Morris chart -->
<script src="{{ asset('assets/js/morris.min.js') }}"></script>

</body>
</html>
