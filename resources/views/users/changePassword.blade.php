@extends('layouts.main')

@section('title', 'Change password')

@section('content-header', 'Users')

@section('content-header-sm', 'Change password')

@section('content-header-fa', 'users')

@section('content-header-fa-sm', 'pencil')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-header">
				<h3 class="box-title">Change password</h3>
			</div>
			<div class="box-body">
				<ul class="nav nav-tabs" style="margin-bottom: 15px;">
					<li role="presentation"><a href='{{ asset("users/$user->user_id/edit") }}'>Edit information</a></li>
					<li role="presentation" class="active"><a href='{{ asset("users/$user->user_id/change_password") }}'>Change password</a></li>
				</ul>
				{!! Form::model($user, ['route' => ['users.changePassword', $user->user_id], 'files' => true, 'method' => 'PATCH']) !!}
					@if ($errors->any())
						<div class="col-md-12">
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
						</div>
					@endif

					<div class="form-group col-md-12">
						{!! Form::label('old_password', 'Old password:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock"></i></div>
							{!! Form::password('old_password', ['class' => 'form-control', 'required']) !!}
						</div>
					</div>
	              	<div class="form-group col-md-12">
						{!! Form::label('new_password', 'New password:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock"></i></div>
							{!! Form::password('new_password', ['class' => 'form-control', 'required']) !!}
						</div>
					</div>
					<div class="form-group col-md-12">
						{!! Form::label('password_confirmation', 'New password confirmation:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-lock"></i></div>
							{!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
						</div>
					</div>
					<div class="form-group col-md-12 text-center">
						{!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
						{!! Form::button('Cancel', ['class' => 'btn btn-primary']) !!}
					</div>
	            {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection