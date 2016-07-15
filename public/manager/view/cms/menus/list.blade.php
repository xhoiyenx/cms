<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 1.0.0
 * Last Update: 07/09/2016
 *
 * Domain: 
 * Manager
 *
 * Type:
 * Template
 * 
 * Description:
 * CMS Menus page
 */
?>
@extends('inc.master')
@section('content')
<h1 class="manager-title clearfix">
  <i class="fa fa-fw fa-list"></i>{{ $page or '' }}
  @if (Request::has('sub'))
  <a class="btn btn-primary btn-quirk pull-right" href="{{ route('manager.cms.menu.create', ['sub' => Request::get('sub')]) }}">Add New</a>
  @else
  <a class="btn btn-primary btn-quirk pull-right" href="{{ route('manager.cms.menu.create') }}">Add New</a>
  @endif
</h1>
{{ Form::open(['route' => 'manager.cms.menu']) }}
<div class="row mb15">
  <div class="col-md-9">

  </div>
  <div class="col-md-3">
    {{ Form::select('menu', config('cms.menus'), Request::get('menu'), ['class' => 'form-control']) }}
  </div>
</div>
@endsection