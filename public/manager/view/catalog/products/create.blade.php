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
{{ Form::open(['route' => 'manager.catalog.product.create']) }}
<div class="people-list">
  <div class="people-options clearfix">
    <div class="pull-left">
      <h3><i class="fa fa-fw fa-gift"></i>New Product</h3>
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

      </div>
    </div>
  </div>
</div>
{{ Form::close() }}
@endsection