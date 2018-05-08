@extends('layouts.main')

@section('title', 'List of Categories')

@section('content-header', 'Categories')

@section('content-header-sm', 'List of Categories')

@section('content-header-fa', 'bars')

@section('content-header-fa-sm', 'th-list')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title">Search category</h3>
      </div>
      <div class="box-body">
        {!! Form::open(['route' => 'categories.index', 'method' => 'GET']) !!}
        <div class="form-group col-md-6">
          {!! Form::label('category_name', 'Category:') !!}
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-bars"></i></div>
            {!! Form::text('category_name', Request::get('category_name'), ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group col-md-6" style="padding-top: 25px;">
          {!! Form::submit('Search', ['class' => 'btn btn-danger']) !!}
          <a href="{{ asset('categories') }}" class="btn btn-default">Reload</a>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<!-- Notification -->
@if (session('message-category')) 
<div class="alert alert-success alert-dismissible" role="alert">
  &#8226; &nbsp; {{ session('message-category') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<!-- Errors -->
@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
  
<div class="row">
  <div class="col-md-12">
   <div class="box box-danger">
     <div class="box-header">
      <h3 class="box-title">List of Categories</h3>
    </div>
    <div class="box-body">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddCategory">Add new category</button>
      <!-- Modal -->
      <div id="modalAddCategory" class="modal fade" role="dialog">
        <div class="modal-dialog">
          {!! Form::open(['route' => 'categories.store', 'method' => 'POST', 'files' => true]) !!}
            @include('categories.modal')
          {!! Form::close() !!}
        </div>
      </div>
      <div class="table-responsive" style="margin-top: 15px;">
       <table class="table table-bordered table-hover">
        <thead style="background-color: #212529; border-color: #32383e; color: #fff;">
         <th class="text-center" width="5%">No.</th>
         <th width="45%">Category</th>
         <th class="text-center" width="40%">Image</th>
         <th width="5%">Edit</th>
         <th width="5%">Delete</th>
       </thead>
       <tbody>
        @if (empty($categories))
          <tr>
            <td colspan="7"><span style="color: red;"><b><i class="fa fa-exclamation-triangle"></i> Not data</b></span></td>
          </tr>
        @else 
          <?php $no = 1;?>
          @foreach ($categories as $category)
          <tr style="line-height: 30px;">
           <td class="text-center">{{ $no }}</td>
           <td>{{ $category->category_name }}</td>
           <td class="text-center">
              @if (!empty($category->category_image) && file_exists(public_path().$category->category_image))
                <img src='{{ asset("$category->category_image") }}' width="100px" height="100px" alt="Category">
              @else 
                <img src='{{ asset("images/no-image.png") }}' width="100px" height="100px" alt="Category">
              @endif
           </td>
           <td>
            <button type="button" name="editCategory" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditCategory-{{ $category->category_id }}"><i class="fa fa-pencil"></i></button>

            <!-- Modal -->
            <div id="modalEditCategory-{{ $category->category_id }}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                {!! Form::model($category, ['files' => true, 'route' => ['categories.update', $category->category_id], 'method' => 'PATCH']) !!}
                  @include('categories.modal')
                {!! Form::close() !!}
              </div>
            </div>
           </td>
           <td>
            <button type="button" name="deleteCategory" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDeleteCategory-{{ $category->category_id }}"><i class="fa fa-trash"></i></button>

            <!-- Modal -->
            <div id="modalDeleteCategory-{{ $category->category_id }}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                {!! Form::open(['route' => ['categories.destroy', $category->category_id], 'method' => 'DELETE']) !!}
                <!-- Token -->
                {{ csrf_field() }}

                <div class="modal-content">
                  <div class="modal-header" style="color: #fff; background-color: #337ab7;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete category</h4>
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
{{ $categories->appends(Request::except('page'))->render() }}
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->
</div>

@endsection