<!-- Token -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<input type="hidden" name="user_token" value="{{ csrf_token() }}">

<!-- Errors -->
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

<!-- Form content -->
<div class="col-md-4 text-center">
	<div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 250px; height: 250px;">
        	@if (isset($user) && !empty($user->user_avatar) && file_exists(public_path().$user->user_avatar)) 
				<img src='{{ asset("$user->user_avatar") }}'>
        	@endif
        </div>
        <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>{!! Form::file('user_avatar') !!}</span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
        </div>
    </div>
</div>

<div class="col-md-8">
	<div class="form-group">
		{!! Form::label('user_name', 'Name:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-user"></i></div>
			{!! Form::text('user_name', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('user_email', 'Email:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-at"></i></div>
			{!! Form::email('user_email', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('user_phone', 'Phone number:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-mobile"></i></div>
			{!! Form::text('user_phone', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('user_address', 'Address:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
			{!! Form::text('user_address', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	
	@if (!isset($user))	
	<div class="form-group">
		{!! Form::label('user_password', 'Password:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-lock"></i></div>
			{!! Form::password('user_password', ['class' => 'form-control', 'required']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('password_confirmation', 'Password confirmation:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-lock"></i></div>
			{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
		</div>
	</div>
	@endif

	@if (isset($user))
	<div class="form-group">
		{!! Form::label('user_role', 'Role:') !!} <span style="color: red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-lock"></i></div>
			{!! Form::select('user_role', ['user' => 'User', 'admin' => 'Admin'], null, ['class' => 'form-control', 'placeholder' => '--- Select role ---']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('coinNumber', 'Coin:') !!} 
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-user"></i></div>
			{!! Form::number('coinNumber', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	@else 
		{!! Form::hidden('user_role', 'user') !!}
		{!! Form::hidden('coinNumber', 0) !!}
	@endif 

</div>
<div class="col-md-12 text-center">
	{!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
	{!! Form::button('Cancel', ['class' => 'btn btn-primary']) !!}
</div>