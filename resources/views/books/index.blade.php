@extends('layouts.main')

@section('title', 'List of Books')

@section('content-header', 'Books')

@section('content-header-sm', 'List of Books')

@section('content-header-fa', 'book')

@section('content-header-fa-sm', 'th-list')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title">Search book</h3>
      </div>
      <div class="box-body">
        {!! Form::open(['route' => 'books.index', 'method' => 'GET']) !!}
        <div class="form-group col-md-6">
          {!! Form::label('book_title', 'Title:') !!}
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-book"></i></div>
            {!! Form::text('book_title', Request::get('book_title'), ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group col-md-6">
          {!! Form::label('category_id', 'Category:') !!}
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-book"></i></div>
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => '--- Select category ---']) !!}
          </div>
        </div>

        <div class="form-group col-md-12 text-center">
          {!! Form::submit('Search', ['class' => 'btn btn-danger']) !!}
          {!! Form::button('Reset', ['type' => 'reset', 'class' => 'btn btn-default']) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<!-- Notification -->
@if (session('message-book')) 
<div class="alert alert-success alert-dismissible" role="alert">
  &#8226; &nbsp; {{ session('message-book') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="row">
  <div class="col-md-12">
   <div class="box box-danger">
     <div class="box-header">
      <h3 class="box-title">List of Books</h3>
    </div>
    <div class="box-body">
      <a href='{{ asset("books") }}' class="btn btn-success">Reload</a>
      <div class="table-responsive" style="margin-top: 15px;">
       <table class="table table-bordered table-hover">
        <thead  style="background-color: #212529; border-color: #32383e; color: #fff;">
         <th class="text-center" width="5%">No.</th>
         <th width="20%">Title</th>
         <th width="40%">Content</th>
         <th width="15%">Category</th>
         <th width="10%">Price</th>
         <th width="5%">Detail</th>
         <th width="5%">Delete</th>
       </thead>
       <tbody>
        @if (empty($books))
          <tr>
            <td colspan="7"><span style="color: red;"><b><i class="fa fa-exclamation-triangle"></i> Not data</b></span></td>
          </tr>
        @else 
          <?php $no = 1;?>
          @foreach ($books as $book)
          <tr>
           <td class="text-center">{{ $no }}</td>
           <td>{{ $book->book_title }}</td>
           <td>{{ $book->book_content }}</td>
           <td>{{ $book->category_name }}</td>
           <td>{{ $book->book_price }}</td>
           <td><a href='{{ asset("books/$book->book_id") }}' class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a></td>
           <td>
            <button type="button" name="deleteBook" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete-{{ $book->book_id }}"><i class="fa fa-trash"></i></button>

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
          </td>
        </tr>
        <?php $no ++; ?>
        @endforeach
      @endif
    </tbody>
  </table>
</div>
{{ $books->appends(Request::except('page'))->render() }}
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->
</div>

@endsection