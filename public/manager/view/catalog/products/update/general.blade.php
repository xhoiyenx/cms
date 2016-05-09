<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 09/03/2016
 *
 * Domain: 
 * Manager
 *
 * Type:
 * Template
 * 
 * Description:
 * Products page
 */
?>
@extends('inc.master')
@section('content')
{{ Form::model($form, ['route' => 'manager.catalog.product.save']) }}
{{ Form::hidden('id', $form->id) }}
<h1 class="manager-title clearfix">
  <i class="fa fa-fw fa-gift"></i>{{ $page }}
  <div class="btn-toolbar pull-right">
    <button type="submit" class="btn btn-success btn-quirk">Save</button>
    <a href="{{ route('manager.catalog.product') }}" class="btn btn-primary btn-quirk">Cancel</a>
  </div>  
</h1>
@include('inc.messages')
@include('catalog.products.update.menu')
<div class="row">
  <div class="col-md-9">

    <div class="panel">
      <div class="panel-body">

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Name:</label>
              {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group nomargin">
              <label>Description:</label>
              {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
              {!! redactor('description') !!}
            </div>
          </div>

        </div>
        
      </div>
    </div>

    <div class="panel">
      <div class="panel-body form-horizontal form-set">

        <div class="form-group">
          <label class="col-md-3 control-label">SKU</label>
          <div class="col-md-9">
            {{ Form::text('sku', null, ['class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">Price</label>
          <div class="col-md-9">
            {{ Form::text('price', null, ['class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">Stock Management</label>
          <div class="col-md-9">
            {{ Form::select('use_stock', ['n' => 'No', 'y' => 'Yes'], null, ['class' => 'form-control']) }}
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label">Stock Quantity</label>
          <div class="col-md-9">
            {{ Form::text('qty_stock', null, ['class' => 'form-control']) }}
          </div>
        </div>        

      </div>
    </div>    
    

  </div>  
  <div class="col-md-3">
    <!-- CATEGORIES -->
  </div>
</div>


{{ Form::close() }}
@endsection
@section('after_footer')
<script type="text/javascript">
$(document).ready(function() {
  // Disable stock quantity if user do not use stock
  $use_stock = $('select[name=use_stock]');
  $qty_stock = $('input[name=qty_stock]');
  if ( $use_stock.val() == 'n' ) {
    $qty_stock.prop('disabled', true);
  }
  else {
    $qty_stock.prop('disabled', false);
  }

  $use_stock.change(function(event) {
    if ( $use_stock.val() == 'n' ) {
      $qty_stock.prop('disabled', true);
    }
    else {
      $qty_stock.prop('disabled', false);
    }
  });

});
</script>
@endsection