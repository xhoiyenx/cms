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

<div class="people-list">
  <div class="people-options clearfix">
    <div class="pull-left">
      <h3><i class="fa fa-fw fa-gift"></i>@if ($form->status == 'draft')New @else Edit @endif Product</h3>
    </div>
    <div class="btn-toolbar pull-right">
      <button type="submit" class="btn btn-success btn-quirk">Save</button>
      <a href="{{ route('manager.catalog.product') }}" class="btn btn-primary btn-quirk">Cancel</a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <!-- CATEGORIES -->
    <div class="panel panel-primary">
      <ul class="panel-options">
        <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
      </ul>
      <div class="panel-heading">
        <h4 class="panel-title">Categories</h4>
      </div>
      <div class="panel-body">
        
        <ul class="checkbox-tree">
          <li>
            <label class="ckbox ckbox-primary">
              <input checked="" type="checkbox"><span>Checkbox Primary</span>
            </label>
          </li>
          <li>
            <label class="ckbox ckbox-primary">
              <input checked="" type="checkbox"><span>Checkbox Primary</span>
            </label>
          </li>
          <li>
            <label class="ckbox ckbox-primary">
              <input checked="" type="checkbox"><span>Checkbox Primary</span>
            </label>
            <ul>
              <li>
                <label class="ckbox ckbox-primary">
                  <input checked="" type="checkbox"><span>Checkbox Primary</span>
                </label>
              </li>
              <li>
                <label class="ckbox ckbox-primary">
                  <input checked="" type="checkbox"><span>Checkbox Primary</span>
                </label>
              </li>
            </ul>
          </li>
        </ul>

      </div>
    </div>

  </div>
  <div class="col-md-9">

    <div class="panel panel-inverse">
      <ul class="panel-options">
        <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
      </ul>
      <div class="panel-heading">
        <h4 class="panel-title">Information</h4>
      </div>
      <div class="panel-body">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name:</label>
              {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Price:</label>
              {{ Form::text('price', null, ['class' => 'form-control']) }}
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label>Description:</label>
              {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
            </div>
          </div>
        </div>
        
      </div>
    </div>
    
    <div class="panel panel-inverse-full">
      <ul class="panel-options">
        <li><a class="panel-minimize"><i class="fa fa-chevron-down"></i></a></li>
      </ul>
      <div class="panel-heading">
        <h3 class="panel-title">Media</h3>
      </div>
      <div class="panel-body">
        <div class="panel-actions">
          <a href="{{ route('manager.catalog.product.media') }}" data-id="{{ $form->id }}" data-action="insert" class="btn btn-success btn-quirk show-form">upload media</a>
        </div>
        <div class="row filemanager">
        </div>

      </div>
    </div>

  </div>  
</div>

{{ Form::close() }}
@endsection
@section('after_footer')
<script type="text/javascript">
$(document).ready(function() {

  $('.show-form').click(function(event) {
    event.preventDefault();

    $.post( $(this).attr('href'),
    {
      id: $(this).data('id'),
      action: $(this).data('action'),
    },
    function(data) {
      if ( data == 2 ) {
        $.gritter.add({
          title: 'Success',
          text: 'Media data deleted',
          class_name: 'with-icon check-circle'
        });
      }
      else {
        $('.modal-content').html(data);
      }
    });
    $('.modal').modal('show');

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