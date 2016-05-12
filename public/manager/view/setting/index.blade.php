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
$label = 'control-label col-sm-3';
?>
@extends('inc.master')
@section('content')

{{ Form::open( ['class' => 'form-horizontal'] ) }}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-body form-horizontal form-set">
        <div class="form-group">
          {{ Form::label('site_title', 'Site Title', ['class' => $label]) }}
          <div class="col-md-9">
            {{ Form::text('site_title', null, ['class' => 'form-control']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('site_description', 'Site Description', ['class' => $label]) }}
          <div class="col-md-9">
            {{ Form::text('site_description', null, ['class' => 'form-control']) }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('site_copyright', 'Copyright', ['class' => $label]) }}
          <div class="col-md-9">
            {{ Form::text('site_copyright', null, ['class' => 'form-control']) }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{ Form::close() }}

@endsection