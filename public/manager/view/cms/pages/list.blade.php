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
  <i class="fa fa-fw fa-list"></i>{{ $page }}
  @if (Request::has('parent'))
  <a class="btn btn-primary btn-quirk pull-right" href="{{ route('manager.cms.page.create', ['parent' => Request::get('parent')]) }}">Add New</a>
  @else
  <a class="btn btn-primary btn-quirk pull-right" href="{{ route('manager.cms.page.update') }}">Add New</a>
  @endif
</h1>
{{ Form::open(['route' => 'manager.cms.page']) }}
<div class="row mb15">
  <div class="col-md-9">

  @if ( count($breadcrumb) > 0 )
    <ol class="breadcrumb breadcrumb-quirk nomargin">
      <li><a href="{{ route('manager.cms.page') }}">Pages</a></li>
    @foreach ( $breadcrumb as $i => $crumb )
      @if ( count($breadcrumb) == ($i+1) )
      <li class="active">{{ $crumb->name }}</li>
      @else
      <li><a href="{{ route('manager.cms.page', ['parent' => $crumb->id]) }}">{{ $crumb->name }}</a></li>
      @endif
    @endforeach
    </ol>
  @endif

  </div>
  <div class="col-md-3">
    <div class="input-group">
      {{ Form::text('search', Request::get('search'), ['class' => 'form-control', 'placeholder' => 'Search for...']) }}
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
    </div><!-- /input-group -->  
  </div>
</div>
@include('inc.messages')
<div class="panel">
<table class="table table-bordered table-primary">
  <thead>
    <tr>
      <th class="cbox"><input type="checkbox" class="checkall"></th>
      <th>title</th>
    </tr>
  </thead>
  <tbody>
    @forelse ( $list as $data )
    <tr>
      <td class="cbox"><input type="checkbox" name="delete[]" value="{{ $data->id }}"></td>
      <td>
        <a href="{{ route('manager.cms.page.update', ['id' => $data->id]) }}" title="Edit {{ $data->name }}"><strong>{{ $data->name }}</strong></a>
        <div class="action-block">
          <a href="{{ route('manager.cms.page', ['parent' => $data->id]) }}">subpage</a>
        </div>
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
<input type="submit" value="Delete Checked" class="btn btn-small btn-quirk btn-primary delete">
{!! $list->links() !!}
{{ Form::close() }}
@endsection