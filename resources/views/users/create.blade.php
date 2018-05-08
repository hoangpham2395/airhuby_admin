@extends('layouts.main')

@section('title', 'Add new user')

@section('content-header', 'Users')

@section('content-header-sm', 'Add new user')

@section('content-header-fa', 'users')

@section('content-header-fa-sm', 'plus')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-header">
				<h3 class="box-title">Add new user</h3>
			</div>
			<div class="box-body">
				
				{!! Form::open(['route' => 'users.store', 'files' => true]) !!}
					@include('users.form')
				{!! Form::close() !!}

			</div>
		</div>
	</div>
</div>
@endsection