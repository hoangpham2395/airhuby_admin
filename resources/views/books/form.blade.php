<!-- Token -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

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

<div class="form-group col-md-6">
    <!-- <label for="book_title">Title: <span style="color:red;"><b>[<i class="fa fa-asterisk"></i>]</b></span></label> -->
    {!! Form::label('book_title', 'Title:') !!} <span style="color:red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-book"></i></div>
        <!-- <input type="text" name="book_title" class="form-control" value="{{ old('book_title') }}"> -->
        {!! Form::text('book_title', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-md-6">
    <!-- <label for="">Category: <span style="color:red;"><b>[<i class="fa fa-asterisk"></i>]</b></span></label> -->
    {!! Form::label('category_id', 'Category:') !!} <span style="color:red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-bars"></i></div>
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => '--- Select category ---']) !!}
    </div>
</div>

<div class="form-group col-md-12">
    <!-- <label for="book_description">Description: <span style="color:red;"><b>[<i class="fa fa-asterisk"></i>]</b></span></label> -->
    {!! Form::label('book_description', 'Description:') !!} <span style="color:red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
    <!-- <textarea name="book_description" rows="5" class="form-control" value="{{ old('book_description') }}"></textarea> -->
    {!! Form::textarea('book_description', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>

<div class="form-group col-md-12">
    {!! Form::label('book_content', 'Content:') !!} <span style="color:red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
    {!! Form::textarea('book_content', null, ['class' => 'form-control', 'rows' => '5']) !!}
</div>

<input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">

<div class="form-group col-md-6">
    {!! Form::label("image_before",'Image before:') !!} 
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-image"></i></div>
        {!! Form::file('image_before', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-md-6">
    {!! Form::label("image_after",'Image after:') !!} 
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-image"></i></div>
        {!! Form::file('image_after', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-md-6">
    {!! Form::label("book_price", 'Price:') !!} <span style="color:red;"><b>[<i class="fa fa-asterisk"></i>]</b></span>
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-money"></i></div>
        {!! Form::text('book_price', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-md-6">
    {!! Form::label('book_count', 'Count:') !!} 
    <div class="input-group">
        <div class="input-group-addon"><i class="fa fa-calculator"></i></div>
        {!! Form::number('book_count', null, ['class' => 'form-control']) !!}
    </div>
</div>

<input type="hidden" name="date_upload">

<div class="form-group col-md-12 text-center">
    <!-- <button type="submit" class="btn btn-danger" name="addNewBook">Save</button> -->
    {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
    {!! Form::button('Reset', ['class' => 'btn btn-default', 'type' => 'reset']) !!}
</div>