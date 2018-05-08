@extends('layouts.main')

@section('title', 'Book information')

@section('content-header', 'Books')

@section('content-header-sm', 'Book information')

@section('content-header-fa', 'book')

@section('content-header-fa-sm', 'list')

@section('content')

<div class="row">
    <div class="col-md-12">
      	<div class="box box-danger">
        	<div class="box-header">
          		<h3 class="box-title">Book information</h3>
        	</div>
        	<div class="box-body">
                <!-- Notification -->
                @if (session('message-book')) 
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                      &#8226; &nbsp; {{ session('message-book') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
                @endif
                @if (is_null($book))
                    <div class="col-md-12 text-center">
                        <span style="color:red; font-size: 16px;"><i class="fa fa-exclamation-triangle"></i> Not data</span>
                    </div>
                @else
                    <div class="col-md-3">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    @if (!empty($book->image_before) && file_exists(public_path().$book->image_before))
                                        <img src='{{ asset("$book->image_before") }}' alt="Image before">
                                    @else 
                                        <img src='{{ asset("images/no-image.png") }}' alt="Image before">
                                    @endif 
                                    <div class="carousel-caption">
                                        <h3>Image before</h3>
                                    </div>
                                </div>

                                <div class="item">
                                    @if (!empty($book->image_before) && file_exists(public_path().$book->image_before))
                                        <img src='{{ asset("$book->image_after") }}' alt="Image after">
                                    @else 
                                        <img src='{{ asset("images/no-image.png") }}' alt="Image after">
                                    @endif 
                                    <div class="carousel-caption">
                                        <h3>Image after</h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <a href='{{ asset("books/$book->book_id/edit") }}' class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                        <button type="button" name="deleteBook" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete-{{ $book->book_id }}"><i class="fa fa-trash"></i></button>

                        <!-- Modal -->
                        <div id="modalDelete-{{ $book->book_id }}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                {!! Form::open(['route' => ['books.destroy', $book->book_id], 'method' => 'DELETE']) !!}
                                    <div class="modal-content">
                                        <div class="modal-header" style="color: #fff; background-color: #337ab7;">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Delete book</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <span style="padding-left: 15px;">Are you sure delete?</span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <a href="{{ asset('books') }}" class="btn btn-default" title="Back to list of books"><i class="fa fa-backward"></i></a>
                        <div class="table-responsive" style="margin-top: 15px;">
                            <table class="table table-bordered table-hover">
                                <thead style="background-color: #212529; border-color: #32383e; color: #fff;">
                                    <th width="20%"></th>
                                    <th width="80%" class="text-center">Detail</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Title</td>
                                        <td><b>{{ $book->book_title }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td><b>{{ $book->book_description }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Content</td>
                                        <td><b>{{ $book->book_content }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td><b>{{ $book->category_name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Poster</td>
                                        <td><b>{{ $book->user_name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><b>{{ $book->book_price }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Count</td>
                                        <td><b>{{ $book->book_count }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            @endif
        	<!-- /.box-body -->
	    </div>
	    <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@endsection