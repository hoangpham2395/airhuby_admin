@extends('layouts.main')

@section('title', 'List of Users')

@section('content-header', 'Users')

@section('content-header-sm', 'List of Users')

@section('content-header-fa', 'users')

@section('content-header-fa-sm', 'th-list')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title">Search user</h3>
      </div>
      <div class="box-body">
        {!! Form::open(['route' => 'users.index', 'method' => 'GET']) !!}
        <div class="form-group col-md-6">
          {!! Form::label('user_name', 'Name:') !!}
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            {!! Form::text('user_name', Request::get('user_name'), ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group col-md-6">
          {!! Form::label('user_email', 'Email:') !!}
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-at"></i></div>
            {!! Form::text('user_email', Request::get('user_email'), ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group col-md-6">
          {!! Form::label('user_phone', 'Phone number:') !!}
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
            {!! Form::text('user_phone', Request::get('user_phone'), ['class' => 'form-control']) !!}
          </div>
        </div>

        <div class="form-group col-md-6">
          {!! Form::label('user_address', 'Address:') !!}
          <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
            {!! Form::text('user_address', Request::get('user_address'), ['class' => 'form-control']) !!}
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
@if (session('message-user')) 
<div class="alert alert-success alert-dismissible" role="alert">
  &#8226; &nbsp; {{ session('message-user') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="row">
  <div class="col-md-12">
   <div class="box box-danger">
     <div class="box-header">
      <h3 class="box-title">List of Users</h3>
    </div>
    <div class="box-body">
      <a href='{{ asset("users") }}' class="btn btn-success">Reload</a>
      <div class="table-responsive" style="margin-top: 15px;">
       <table class="table table-bordered table-hover">
        <thead  style="background-color: #212529; border-color: #32383e; color: #fff;">
         <th class="text-center" width="5%">No.</th>
         <th width="20%">Name</th>
         <th width="25%">Email</th>
         <th width="10%">Phone</th>
         <th width="30%">Address</th>
         <th width="5%">Detail</th>
         <th width="5%">Delete</th>
       </thead>
       <tbody>
        @if (empty($users))
          <tr>
            <td colspan="7"><span style="color: red;"><b><i class="fa fa-exclamation-triangle"></i> Not data</b></span></td>
          </tr>
        @else 
          <?php $no = 1;?>
          @foreach ($users as $user)
          <tr>
           <td class="text-center">{{ $no }}</td>
           <td>{{ $user->user_name }}</td>
           <td>{{ $user->user_email }}</td>
           <td>{{ $user->user_phone }}</td>
           <td>{{ $user->user_address }}</td>
           <td><a href='{{ asset("users/$user->user_id") }}' class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a></td>
           <td>
            <button type="button" name="deleteUser" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalDelete-{{ $user->user_id }}"><i class="fa fa-trash"></i></button>

            <!-- Modal -->
            <div id="modalDelete-{{ $user->user_id }}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                {!! Form::open(['route' => ['users.destroy', $user->user_id], 'method' => 'DELETE']) !!}
                <div class="modal-content">
                  <div class="modal-header" style="color: #fff; background-color: #337ab7;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete user</h4>
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
{{ $users->appends(Request::except('page'))->render() }}
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
<!-- /.col -->
</div>

@endsection