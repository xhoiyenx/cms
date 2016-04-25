<div class="ajax-form">
  @if ( ! $product->variations->isEmpty())
  {{ Form::model( $form, ['route' => 'manager.catalog.product.variation'] ) }}
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add Product Variation</h3>
  </div>
  <div class="modal-body">
    
    @include('inc.ajax-messages')

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-primary" name="save" value="1">Save changes</button>
  </div>
  {{ Form::close() }}
  @else
  <div class="modal-body">
    @include('inc.ajax-messages')
  </div>
  @endif
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('select').select2({
    dropdownParent: $('.modal')
  });
});
</script>