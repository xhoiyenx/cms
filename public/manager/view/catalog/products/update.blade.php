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
 * Product update form
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
<ul class="nav nav-tabs nav-line">
  <li class="active">
    <a href="#general" data-toggle="tab"><strong>General</strong></a>
  </li>
  <li>
    <a href="#images" data-toggle="tab"><strong>Images</strong></a>
  </li>
</ul>

<div class="tab-content">
  <div id="general" class="tab-pane active">
    @include('catalog.products.form.general')
  </div>
  <div id="images" class="tab-pane">
    @include('catalog.products.form.images')
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

  $('.modal-content').on('submit', 'form', function(event) {
    event.preventDefault();
    $.ajax({
      url: $(this).attr('action'), 
      type: 'POST',             
      data: new FormData($(this)[0]),
      contentType: false,       
      cache: false,             
      processData:false,        
      success: function(data) {
        if ( data == 1 ) {
          $.gritter.add({
            title: 'Success',
            text: 'Media data saved',
            class_name: 'with-icon check-circle'
          });
          $('.modal').modal('hide');

          /* reload media */
          loadMedia();
        }
        else {
          $('.modal-content').html(data);
        }
      }
    });
  });

  function loadMedia()
  {
    $('.filemanager').load('<?php echo route('manager.catalog.product.media-list')?>',{ id: <?php echo $form->id?> } ,
      function(){
      /* Stuff to do after the page is loaded */
    });
  }

});
</script>
@endsection