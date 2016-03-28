@if ( $edit )
{{ Form::model($edit, ['files' => true] ) }}
{{ Form::hidden('action', 'update') }}
@else
{{ Form::open( ['files' => true] ) }}
{{ Form::hidden('action', 'insert') }}
@endif
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
  {{ Form::hidden('id', request()->get('id')) }}
  {{ Form::hidden('save', 1) }}
</div>
{{ Form::close() }}