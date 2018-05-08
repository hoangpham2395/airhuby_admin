<!-- Token -->
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="modal-content">
  <div class="modal-header" style="color: #fff; background-color: #337ab7;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Add new category</h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="form-group col-md-5 text-center">
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
            @if (isset($category) && !empty($category->category_image) && file_exists(public_path().$category->category_image))
              <img src='{{ asset("$category->category_image") }}'>
            @endif
          </div>
          <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>{!! Form::file('category_image') !!}</span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
          </div>
        </div>
      </div>
      <div class="form-group col-md-7">
        {!! Form::label('category_name', 'Category:') !!}
        <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-bars"></i></div>
          {!! Form::text('category_name', null, ['class' => 'form-control', 'required']) !!}
        </div>
      </div>

      <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
  </div>
</div>