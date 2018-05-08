@extends('layouts.main')

@section('title', 'Edit user')

@section('content-header', 'Users')

@section('content-header-sm', 'Edit user')

@section('content-header-fa', 'users')

@section('content-header-fa-sm', 'pencil')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-header">
				<h3 class="box-title">Edit user</h3>
			</div>
			<div class="box-body">
				<ul class="nav nav-tabs"  style="margin-bottom: 15px;">
					<li role="presentation" class="active"><a href='{{ asset("users/$user->user_id/edit") }}'>Edit information</a></li>
					<li role="presentation"><a href='{{ asset("users/$user->user_id/change_password") }}'>Change password</a></li>
				</ul>
				{!! Form::model($user, ['route' => ['users.update', $user->user_id], 'files' => true, 'method' => 'PATCH']) !!}
	              @include('users.form')
	            {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection