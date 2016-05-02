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
  <i class="fa fa-fw fa-share-alt"></i>{{ $page }}
  @if ( request()->has('group') )
  <a class="btn btn-danger btn-quirk pull-right ml10" href="{{ route('manager.catalog.attributes') }}">Cancel</a>
  @endif
  <a class="btn btn-primary btn-quirk btn-form pull-right" data-parent="{{ request()->get('group', 0) }}" href="{{ route('manager.catalog.attributes.update') }}">Add New</a>
</h1>
@include('inc.messages')
{{ Form::open(['route' => 'manager.catalog.attributes.action']) }}
<div class="panel">
<table class="table table-bordered table-hover table-primary">
  <thead>
    <tr>
      <th class="cbox"><input type="checkbox" class="checkall"></th>
      <th width="80%">name</th>
      <th width="15%" class="text-center">action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ( $list as $data )
    <tr>
      <td class="cbox"><input type="checkbox" name="delete[]" value="{{ $data['id'] }}"></td>
      @if ( $data['parent'] != 0 )
      <td>{{ $data['name'] }}</td>
      @else
      <td><strong><a href="{{ route('manager.catalog.attributes') }}?group={{ $data['id'] }}">{{ $data['name'] }}</a></strong></td>
      @endif
      <td class="text-center">
        <ul class="table-options">
          <li><a class="btn-form" data-id="{{ $data['id'] }}" data-parent="{{ request()->get('group', 0) }}" href="{{ route('manager.catalog.attributes.update') }}" title="Edit"><i class="fa fa-fw fa-pencil"></i></a></li>
          <li><a href="{{ route('manager.catalog.attributes') }}?delete={{ $data['id'] }}" title="Delete"><i class="fa fa-fw fa-trash"></i></a></li>
        </ul>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="3">No Data Found</td>
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
          window.location.href = '{{ request()->fullUrl() }}';
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