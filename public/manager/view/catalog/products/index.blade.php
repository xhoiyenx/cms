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
<h1 class="manager-title clearfix">
  <i class="fa fa-fw fa-gift"></i>Products
  <a class="btn btn-success btn-quirk pull-right" href="{{ route('manager.catalog.product.update') }}">Add New</a>
</h1>
@include('inc.messages')
<div class="panel">
<table class="table table-bordered table-primary table-striped">
  <thead>
    <th>name</th>
    <th>price</th>
    <th width="15%" class="text-center">action</th>
  </thead>
  <tbody>
    @forelse ( $list as $data )
    <tr>
      <td>{{ $data->name }}</td>
      <td>{{ $data->getPrice() }}</td>
      <td class="text-center">
        <ul class="table-options">
          <li><a href="{{ route('manager.catalog.product.update', ['id' => $data->id]) }}" title="Edit"><i class="fa fa-fw fa-pencil"></i></a></li>
          <li><a href="{{ route('manager.catalog.product.delete', ['id' => $data->id]) }}" title="Delete"><i class="fa fa-fw fa-trash"></i></a></li>
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
{!! $list->links() !!}
@endsection