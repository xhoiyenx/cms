<div class="ajax-form">
  @if ( isset($edit) )
  {{ Form::model($edit, ['route' => 'manager.catalog.attributes.update'] ) }}
  {{ Form::hidden('id', $edit->id) }}
  @else
  {{ Form::open( ['route' => 'manager.catalog.attributes.update'] ) }}
  @endif
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{ $page }}</h3>
  </div>
  <div class="modal-body">
    
    @include('inc.ajax-messages')
    <div class="form-group">
      <label>Name:</label>
      {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
      <label>Sort:</label>
      {{ Form::text('sort', null, ['class' => 'form-control']) }}
    </div>    

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-primary" name="save" value="1">Save changes</button>
  </div>
  {{ Form::hidden('parent', request()->get('parent', 0)) }}
  {{ Form::close() }}
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('select').select2({
    dropdownParent: $('.modal')
  });
});
</script>