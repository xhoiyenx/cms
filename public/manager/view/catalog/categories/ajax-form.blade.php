@if ( $edit )
{{ Form::model($edit, ['route' => 'manager.catalog.categories.save'] ) }}
{{ Form::hidden('id', $edit->id) }}
@else
{{ Form::open( ['route' => 'manager.catalog.categories.save'] ) }}
@endif
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  @if ( $edit )
  <h4 class="modal-title">Edit '{{ $edit->name }}'</h3>
  @else
  <h4 class="modal-title">Add Category</h3>
  @endif
</div>
<div class="modal-body">
  
  @include('inc.messages', ['type' => 'SaveCategory'])
  <div class="form-group">
    <label>Name:</label>
    {{ Form::text('name', null, ['class' => 'form-control']) }}
  </div>

  <div class="form-group">
    <label>Parent:</label>
    <select name="parent_id" class="form-control" style="width: 100%">
      {!! Library\Repository\ProductCategoryRepo::selectTree( $edit ) !!}
    </select>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button class="btn btn-primary" name="save">Save changes</button>
</div>
{{ Form::close() }}
<script type="text/javascript">
$(document).ready(function() {
  $('select').select2();  
});
</script>