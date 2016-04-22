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
{{ Form::model($form, ['route' => 'manager.roles.save']) }}
<h1 class="manager-title clearfix">
  <i class="fa fa-fw fa-gift"></i>{{ $page }}
  <div class="btn-toolbar pull-right">
    <button type="submit" class="btn btn-success btn-quirk">Save</button>
    <a href="{{ route('manager.roles') }}" class="btn btn-primary btn-quirk">Cancel</a>
  </div>  
</h1>

<div class="panel panel-inverse">
  <div class="panel-body">

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Name:</label>
          {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
      </div>

    </div>
    
  </div>
</div>

<div class="panel panel-inverse">
  <div class="panel-heading">
    <h3 class="panel-title">Permissions</h3>
  </div>
  <div class="panel-body form-horizontal form-set">

    <div class="form-group">
      <label class="col-md-3 control-label"><strong>Catalog</strong></label>
      <div class="col-md-9">
        <h5>Attributes</h5>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-3 control-label">Price</label>
      <div class="col-md-9">
        {{ Form::text('price', null, ['class' => 'form-control']) }}
      </div>
    </div>
    
  </div>
</div>



{{ Form::close() }}
@endsection