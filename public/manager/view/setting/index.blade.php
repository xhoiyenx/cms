<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 06/03/2016
 *
 * Domain: 
 * Manager
 *
 * Type:
 * Template
 * 
 * Description:
 * Configuration page
 */
?>
@extends('inc.master')
@section('content')

{{ Form::open( ['class' => 'form-horizontal'] ) }}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">General</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          {{ Form::label('site_title', 'Site Title', ['class' => 'control-label col-sm-3']) }}
          <div class="col-sm-8">
            {{ Form::text('site_title', null, ['class' => 'form-control']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('site_description', 'Site Description', ['class' => 'control-label col-sm-3']) }}
          <div class="col-sm-8">
            {{ Form::text('site_description', null, ['class' => 'form-control']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('site_copyright', 'Copyright', ['class' => 'control-label col-sm-3']) }}
          <div class="col-sm-8">
            {{ Form::text('site_copyright', null, ['class' => 'form-control']) }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{ Form::close() }}

@endsection