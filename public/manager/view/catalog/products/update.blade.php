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

<ul class="nav nav-tabs nav-line">
  <li class="active">
    <a href="#general" data-toggle="tab"><strong>General</strong></a>
  </li>
  <li>
    <a href="#variation" data-toggle="tab"><strong>Variations</strong></a>
  </li>
</ul>

<div class="tab-content">
  <div id="general" class="tab-pane active">
    @include('catalog.products.general-update')
  </div>
  <div id="variation" class="tab-pane">
    @include('catalog.products.variation-update')
  </div>
</div>


{{ Form::close() }}
@endsection
@section('after_footer')
<script type="text/javascript">
$(document).ready(function() {

  $('input[name="attribute[]"]').on('change', function(event) {

    var $checked_attr = $('input[name="attribute[]"]:checked').map(function(){
      return $(this).val();
    }).get();

    $.post('{{ route('manager.catalog.product.save') }}', {attribute: $checked_attr, id: '{{ $form->id}}'}, function(data, textStatus, xhr) {
      /*optional stuff to do after success */
    });
    
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

  /* load media */
  loadMedia();
  
});

function loadMedia()
{
  $('.filemanager').load('<?php echo route('manager.catalog.product.media-list')?>',{ id: <?php echo $form->id?> } ,
    function(){
    /* Stuff to do after the page is loaded */
  });
}
</script>
@endsection