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
{{ Form::model($form, ['route' => 'manager.cms.menu.save']) }}
{{ Form::hidden('id', $form->id) }}
{{ Form::hidden('menu_parent', $form->menu_parent) }}
<h1 class="manager-title clearfix">
  <i class="fa fa-fw fa-file-o"></i>{{ $page or '' }}
  <div class="btn-toolbar pull-right">
    <button type="submit" class="btn btn-success btn-quirk">Save</button>
    <a href="{{ route('manager.cms.menu', ['sub' => Request::get('sub')]) }}" class="btn btn-primary btn-quirk">Exit</a>
  </div>  
</h1>
@include('inc.messages')
<div class="row">
  <div class="col-md-9">

    <div class="panel">
      <div class="panel-body">
        <div class="form-group">
          <label>Name: <span class="required">*</span></label>
          {{ Form::text('menu_name', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
          <label>Type:</label>
          {{ Form::select('link_type', $menu_type, null, ['class' => 'form-control']) }}
        </div>
        <div class="link-types link">
          <div class="form-group">
            <label>Url: <span class="required">*</span></label>
            <div class="input-group">
              <div class="input-group-addon">{{ url('/') }}/</div>
              {{ Form::text('menu_link', null, ['class' => 'form-control']) }}
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="col-md-3">

    <div class="panel">
      <div class="panel-body">
        <div class="form-group">
          <label>Menu:</label>
          {{ Form::select('menu_type', config('cms.menus'), null, ['class' => 'form-control']) }}
        </div>
      </div>
    </div>

  </div>
</div>
{{ Form::close() }}
@endsection

@section('after_footer')
<script type="text/javascript">
$(document).ready(function() {
  $('input[name=menu_name]').focus();
});
</script>
@endsection