@extends('layouts.main')

@section('title', 'Dashboard')

@section('content-header', 'Dashboard')

@section('content-header-sm', 'Index')

@section('content-header-fa', 'dashboard')

@section('content-header-fa-sm', '')

@section('content')

<div class="row">
	<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
              	<h3>{{ $books->count() }}</h3>
              	<p>Books</p>
            </div>
            <div class="icon">
              	<i class="fa fa-book"></i>
            </div>
            <a href="{{ asset('books') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
              	<h3>{{ $categories->count() }}</h3>
              	<p>Categories</p>
            </div>
            <div class="icon">
              	<i class="fa fa-bars"></i>
            </div>
            <a href="{{ asset('categories') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
	
	<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
              	<h3>{{ $users->count() }}</h3>
              	<p>Users</p>
            </div>
            <div class="icon">
              	<i class="fa fa-users"></i>
            </div>
            <a href="{{ asset('users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
	
	<div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
              	<h3>{{ $borrows->count() }}</h3>
              	<p>Borrows</p>
            </div>
            <div class="icon">
              	<i class="fa fa-shopping-cart"></i>
            </div>
            <a href="{{ asset('borrows') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- REPORT -->
<!-- <div class="row">
  <div class="col-md-12">
    <!-- USERS LIST -->
    <!-- <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-line-chart"></i> Report</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
          </button>
        </div>
      </div> -->
      <!-- /.box-header -->
      <!-- <div class="box-body no-padding"> -->
        <!-- Chart -->
        <!-- <div id="line-chart"></div>
      </div> -->
      <!-- /.box-body -->
    <!-- </div> -->
    <!--/.box -->
  <!-- </div> 
</div> -->
<!-- Morris Chart -->
<!-- <script type="text/javascript">
var data = [
      { y: '2014', a: 50, b: 90},
      { y: '2015', a: 65,  b: 75},
      { y: '2016', a: 50,  b: 50},
      { y: '2017', a: 75,  b: 60},
      { y: '2018', a: 80,  b: 65},
      { y: '2019', a: 90,  b: 70},
      { y: '2020', a: 100, b: 75},
      { y: '2021', a: 115, b: 75},
      { y: '2022', a: 120, b: 85},
      { y: '2023', a: 145, b: 85},
      { y: '2024', a: 160, b: 95}
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Total Income', 'Total Outcome'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
  };
config.element = 'line-chart';
Morris.Line(config);
</script> -->

<!-- LIST -->
<div class="row">  
  <!-- User list -->
  <div class="col-md-6">
    <!-- USERS LIST -->
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user"></i> 8 New Members</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <ul class="users-list clearfix">
          <!-- Foreach limit start 0, limit 8 -->
          @foreach ($users->slice(0, 8) as $user)  
          <li>
            @if (!empty($user->user_avatar) && file_exists(public_path().$user->user_avatar))
              <img src='{{ asset("$user->user_avatar") }}' alt="Avatar">
            @else 
              <img src='{{ asset("images/no-image.png") }}' alt="Avatar">
            @endif
            <a class="users-list-name" href='{{ asset("users/$user->user_id") }}'>{{ $user->user_name }}</a>
            <span class="users-list-date">
              @if (!empty($user->created_at))
                {{ $user->created_at->diffForHumans() }}
              @else
                Don't know
              @endif
            </span>
          </li>
          @endforeach
        </ul>
        <!-- /.users-list -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <a href="{{ asset('users') }}" class="uppercase">View All Users</a>
      </div>
      <!-- /.box-footer -->
    </div>
    <!--/.box -->
  </div>
  
  <!-- Book list -->
  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-book"></i> 8 New Books</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <ul class="products-list product-list-in-box">
          @foreach ($books->slice(0, 5) as $book)
          <li class="item">
            <div class="product-img">
              @if (!empty($book->image_before) && file_exists(public_path().$book->image_before))
                <img src='{{ asset("$book->image_before") }}' alt="Book image">
              @else 
                <img src="{{ asset('images/no-image.png') }}" alt="Book image">
              @endif
            </div>
            <div class="product-info">
              <a href='{{ asset("books/$book->book_id") }}' class="product-title">{{ $book->book_title }}
                <span class="label label-warning pull-right">{{ $book->book_price }} coin</span></a>
                  <span class="product-description">
                    {{ $book->book_description }}
                  </span>
                </span>
              </a>
            </div>
          </li>
          <!-- /.item -->
          @endforeach
        </ul>
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <a href="{{ asset('books') }}" class="uppercase">View All Books</a>
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
</div>

@endsection