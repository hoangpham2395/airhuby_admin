@extends('layouts.main')

@section('title', 'Add new book')

@section('content-header', 'Books')

@section('content-header-sm', 'Add new book')

@section('content-header-fa', 'book')

@section('content-header-fa-sm', 'plus')

@section('content')

<div class="row">
    <div class="col-md-12">
      	<div class="box box-danger">
        	<div class="box-header">
          		<h3 class="box-title">Add new book</h3>
        	</div>
        	<div class="box-body">
                <!-- <form action="{{ asset('books') }}" method="post" enctype="multipart/form-data"> -->
                {{ Form::open(['route' => 'books.store', 'files' => true]) }}
                    @include('books.form')
                {!! Form::close() !!}
        	</div>
        	<!-- /.box-body -->
	    </div>
	    <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@endsection