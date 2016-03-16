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
<div class="panel">
  <div class="panel-body panel-form">
    <div class="row">
      <div class="col-md-3">
        <h4>Product Information</h4>
      </div>
      <div class="col-md-9">
        
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
    <div class="row">
      <div class="col-md-3">
        <h4>Product Images</h4>
      </div>
      <div class="col-md-9">
        <div class="col-md-12">
          <div class="panel-actions">
            <a href="{{ route('manager.media.product.upload') }}" data-id="{{ $form->id }}" data-action="insert" class="btn btn-success btn-quirk show-form">upload media</a>
          </div>
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
      content: $(this).data('id'),
      action: $(this).data('action'),
    },
    function(data) {
      if ( data == 2 ) {
        $.gritter.add({
          title: 'Success',
          text: 'Media data deleted',
          class_name: 'with-icon check-circle'
        });
        window.location.href = '{{ request()->url() }}';
      }
      else {
        $('.modal-content').html(data);
      }
    });
    $('.modal').modal('show');

  });  
});
</script>
@endsection