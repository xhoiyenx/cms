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
<div class="people-list">
  <div class="people-options clearfix">
    <div class="pull-left">
      <h3><i class="fa fa-fw fa-gift"></i>Products</h3>
    </div>
    <div class="btn-toolbar pull-right">
      <a class="btn btn-success btn-quirk" href="{{ route('manager.catalog.product.create') }}">Add New</a>
    </div>
  </div>
</div>
@endsection