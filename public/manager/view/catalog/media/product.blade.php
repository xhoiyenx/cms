@if ( $edit )
{{ Form::model($edit, ['files' => true] ) }}
{{ Form::hidden('id', $edit->id) }}
@else
{{ Form::open( ['files' => true] ) }}
@endif
{{ Form::hidden('save', 1) }}
{{ Form::hidden('action', request()->get('action')) }}
{{ Form::hidden('product_id', request()->get('id')) }}
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Upload Media</h4>
</div>
<div class="modal-body">
  
  @include('inc.ajax-messages')
  
  <div class="form-group">
    {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {{ Form::label('sort', 'Sort Order', ['class' => 'form-label']) }}
        {{ Form::text('sort_order', null, ['class' => 'form-control']) }}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        {{ Form::label('upload', 'Upload', ['class' => 'form-label']) }}
        {{ Form::file('media') }}
      </div>
    </div>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button class="btn btn-primary" name="save">Save changes</button>
</div>
{{ Form::close() }}