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
 * Product Categories page
 */
?>
@extends('inc.master')
@section('content')
<div class="row">
  <div class="col-md-4">
  {{ Form::open( ['route' => 'manager.catalog.categories.save'] ) }}
    <div class="panel panel-inverse">
      <div class="panel-heading">
        <h3 class="panel-title">Add New</h3>
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
            {!! Library\Repository\ProductCategoryRepo::selectTree() !!}
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