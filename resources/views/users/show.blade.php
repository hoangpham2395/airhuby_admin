@extends('layouts.main')

@section('title', 'User information')

@section('content-header', 'Users')

@section('content-header-sm', 'User information')

@section('content-header-fa', 'users')

@section('content-header-fa-sm', 'info-circle')

@section('content')

<div class="row">
    <div class="col-md-12">
      	<div class="box box-danger">
        	<div class="box-header">
          		<h3 class="box-title">User information</h3>
        	</div>

        	<div class="box-body">
                 <!-- Notification -->
                @if (session('message-user')) 
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                      &#8226; &nbsp; {{ session('message-user') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </div>
                @endif
                
                @if (is_null($user))
                    <div class="col-md-12 text-center">
                        <span style="color:red; font-size: 16px;"><i class="fa fa-exclamation-triangle"></i> Not data</span>
                    </div>
                @else
                    <div class="col-md-4">
                        @if ((!empty($user->user_avatar)) && (file_exists(public_path().$user->user_avatar)))
                            <img src='{{ asset("$user->user_avatar") }}' style="max-width: 300px; max-height: 300px;" alt="Avatar">
                        @else 
                            <img src='{{ asset("images/no-image.png") }}' style="max-width: 300px; max-height: 300px;" alt="Avatar">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <a href='{{ asset("users/$user->user_id/edit") }}' class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>
                        <button type="button" name="deleteUser" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete-{{ $user->user_id }}"><i class="fa fa-trash"></i></button>

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

                        <a href="{{ asset('users') }}" class="btn btn-default" title="Back to list of users"><i class="fa fa-backward"></i></a>
                        <div class="table-responsive" style="margin-top: 15px;">
                            <table class="table table-bordered table-hover">
                                <thead style="background-color: #212529; border-color: #32383e; color: #fff;">
                                    <th width="20%"></th>
                                    <th width="80%" class="text-center">Detail</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td><b>{{ $user->user_name }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><b>{{ $user->user_email }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Phone number</td>
                                        <td><b>{{ $user->user_phone }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><b>{{ $user->user_address }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td><b>{{ $user->user_role }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Coin</td>
                                        <td><b>{{ $user->user_coinNumber }}</b></td>
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