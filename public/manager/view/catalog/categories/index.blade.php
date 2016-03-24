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
<div class="row">
  <div class="col-md-4">
  @if ( $edit )
  {{ Form::model($edit, ['route' => 'manager.catalog.categories.save'] ) }}
  {{ Form::hidden('id', $edit->id) }}
  @else
  {{ Form::open( ['route' => 'manager.catalog.categories.save'] ) }}
  @endif
    <div class="panel panel-inverse">
      <div class="panel-heading">
        @if ( $edit )
        <h3 class="panel-title">Edit '{{ $edit->name }}'</h3>
        @else
        <h3 class="panel-title">Add New</h3>
        @endif
      </div>
      <div class="panel-body">
        @include('inc.messages', ['type' => 'SaveCategory'])
        <div class="form-group">
          <label>Name:</label>
          {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
          <label>Parent:</label>
          <select name="parent_id" class="form-control" style="width: 100%">
            {!! Library\Repository\ProductCategoryRepo::selectTree( $edit ) !!}
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  {{ Form::close() }}
  </div>
  <div class="col-md-8">
    @include('catalog.categories.table')
  </div>
</div>
@endsection