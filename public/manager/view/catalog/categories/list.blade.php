<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 23/03/2016
 *
 * Domain: 
 * Manager
 *
 * Type:
 * Template
 * 
 * Description:
 * Product Categories page
 */
?>
@extends('inc.master')
@section('content')
<h1 class="manager-title clearfix">
  <i class="fa fa-fw fa-tags"></i>{{ $page }}
  <a class="btn btn-primary btn-quirk btn-form pull-right" href="{{ route('manager.catalog.categories.update') }}">Add New</a>
</h1>
@include('inc.messages')
{{ Form::open(['route' => 'manager.catalog.categories']) }}
<div class="panel">
<table class="table table-bordered table-primary">
  <thead>
    <tr>
      <th class="cbox"><input type="checkbox" class="checkall"></th>
      <th>name</th>
    </tr>
  </thead>
  <tbody>
    @forelse ( $list as $data )
    <tr>
      <td class="cbox"><input type="checkbox" name="delete[]" value="{{ $data['id'] }}"></td>
      <td><a class="btn-form" data-id="{{ $data['id'] }}" href="{{ route('manager.catalog.categories.update') }}" title="Edit">{{ $data['name'] }}</a></td>
    </tr>
    @empty
    <tr>
      <td colspan="2">No Data Found</td>
    </tr>
    @endforelse
  </tbody>
</table>
</div>
<input type="submit" value="Delete Checked" class="btn btn-small btn-quirk btn-primary">
{!! $list->links() !!}
{{ Form::close() }}
@endsection

@section('after_footer')
<script type="text/javascript">
$(document).ready(function() {
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
          $('.modal').modal('hide');
          window.location.href = '{{ request()->url() }}';
        }
        else {
          $('.modal-content').html(data);
        }
      }
    });
  });  
});
</script>
@endsection