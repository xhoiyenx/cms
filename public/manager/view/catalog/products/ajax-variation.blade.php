<div class="ajax-form">
  @if ( $success )
  {{ Form::model( $form, ['route' => 'manager.catalog.product.variation.save'] ) }}
  {{ Form::hidden('parent', $product->id) }}
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add Product Variation</h3>
  </div>
  <div class="modal-body">
    
    @include('inc.ajax-messages')

    <div class="panel panel-inverse">
      <div class="panel-body form-horizontal form-set">
        @foreach ( $product->attributeGroups() as $group )
        <?php
        /**
         * Only show attribute selection if attribute is more than 1
         */
        $attributes = $group->attributeOf($product);
        if ( $attributes->count() < 2 )
          continue;
        ?>
        <div class="form-group">
          <label class="col-md-3 control-label">{{ $group->name }}</label>
          <div class="col-md-9">
            {{ Form::select('variation[]', $group->attributeOf($product), null, ['class' => 'form-control']) }}
          </div>
        </div>
        @endforeach
      </div>
    </div>    

    <div class="row">
      <div class="col-md-6">
        
        <div class="form-group">
          <label>SKU:</label>
          {{ Form::text('sku', null, ['class' => 'form-control']) }}
        </div>

      </div>
      <div class="col-md-6">
        
        <div class="form-group">
          <label>Price:</label>
          <div class="input-group">
            {{ Form::text('price', null, ['class' => 'form-control']) }}
            <span class="input-group-addon"><label><input type="checkbox" name="skip_price" value="1" class="deactivate_neighbor"> <span>Same as product</span></label></span>
          </div>
        </div>

      </div>
      <div class="col-md-6">
        
        <div class="form-group">
          <label>Use Stock Management:</label>
          {{ Form::select('use_stock', ['n' => 'No', 'y' => 'Yes'], null, ['class' => 'form-control use_stock', 'style' => 'width:100%']) }}
        </div>

      </div>
      <div class="col-md-6">
        
        <div class="form-group">
          <label>Stock Quantity:</label>
          {{ Form::text('qty_stock', null, ['class' => 'form-control qty_stock', 'disabled' => 'disabled'] ) }}
        </div>

      </div>      
    </div>

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
  /*
  $('select').select2({
    dropdownParent: $('.modal')
  });
  */

  $('.deactivate_neighbor').change(function(event) {

    if ( $(this).prop('checked') ) {
      $(this).parent().parent().prev('input').attr('disabled', 'disabled');
    }
    else {
      $(this).parent().parent().prev('input').removeAttr('disabled');
    }

  });

  $('.use_stock').change(function(event) {
    
    if ( $(this).val() == 'y' ) {
      $('.qty_stock').removeAttr('disabled');
    }
    else {
      $('.qty_stock').attr('disabled', 'disabled');
    }

  });
});
</script>