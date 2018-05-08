@extends('layouts.main')

@section('title', 'Edit book')

@section('content-header', 'Books')

@section('content-header-sm', 'Edit book')

@section('content-header-fa', 'book')

@section('content-header-fa-sm', 'pencil')

@section('content')

<div class="row">
    <div class="col-md-12">
      	<div class="box box-danger">
        	<div class="box-header">
          		<h3 class="box-title">Edit book</h3>
        	</div>
        	<div class="box-body">
                @if ($errors->any())
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- <form action="{{ asset('books') }}" method="post" enctype="multipart/form-data"> -->
                {!! Form::model($book, ['files' => true, 'method' => 'PATCH', 'route' => ['books.update', $book->book_id]]) !!}
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