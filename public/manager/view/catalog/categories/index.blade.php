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
<div class="people-list">
  <div class="people-options clearfix">
    <div class="pull-left">
      <h3><i class="fa fa-fw fa-tags"></i>Categories</h3>
    </div>
    <div class="btn-toolbar pull-right">
      <a class="btn btn-success btn-quirk btn-form" href="{{ route('manager.catalog.categories.update') }}">Add New</a>
    </div>
  </div>
</div>
@include('inc.messages')
<div class="panel">
<table class="table table-bordered table-hover table-primary">
  <thead>
    <tr>
      <th width="80%">name</th>
      <th width="20%" class="text-center">action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ( $list as $data )
    <tr>
      <td>{{ $data['name'] }}</td>
      <td class="text-center">
        <ul class="table-options">
          <li><a class="btn-form" data-id="{{ $data['id'] }}" href="{{ route('manager.catalog.categories.update') }}" title="Edit"><i class="fa fa-fw fa-pencil"></i></a></li>
          <li><a href="{{ route('manager.catalog.categories') }}?delete={{ $data['id'] }}" title="Delete"><i class="fa fa-fw fa-trash"></i></a></li>
        </ul>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="2">No Data Found</td>
    </tr>
    @endforelse
  </tbody>
</table>
</div>
{!! $list->links() !!}
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