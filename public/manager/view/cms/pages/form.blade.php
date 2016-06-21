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
 * Page update form
 */
?>
@extends('inc.master')
@section('content')
{{ Form::model($form, ['route' => 'manager.cms.page.save']) }}
{{ Form::hidden('id', $form->id) }}
{{ Form::hidden('parent', $form->parent) }}
<h1 class="manager-title clearfix">
  <i class="fa fa-fw fa-file-o"></i>{{ $page }}
  <div class="btn-toolbar pull-right">
    <button type="submit" class="btn btn-success btn-quirk">Save</button>
    <a href="{{ route('manager.cms.page') }}" class="btn btn-primary btn-quirk">Cancel</a>
  </div>  
</h1>
@include('inc.messages')
<div class="row">
  <div class="col-md-12">

    <div class="panel">
      <div class="panel-body">
        <div class="row">

          <div class="col-md-12">
            <div class="form-group">
              <label>Title: <span class="required">*</span></label>
              {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
          </div>

          @if ($form->exists)
          <div class="col-md-12">
            <div class="form-group">
              <label>Url: <span class="help">lowercase and dash text only</span></label>
              <div class="input-group">
                <div class="input-group-addon">{{ url('/') }}/</div>
                {{ Form::text('slug', null, ['class' => 'form-control']) }}
              </div>
            </div>
          </div>
          @endif

          <div class="col-md-12">
            <div class="form-group nomargin">
              <label>Description:</label>
              {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) }}
              {!! redactor('description') !!}
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>


{{ Form::close() }}
@endsection