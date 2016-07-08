<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 05/03/2016
 *
 * Domain: 
 * Manager
 *
 * Type:
 * Template
 * 
 * Description:
 * Manager mainmenu
 */
?>
<ul class="nav nav-pills nav-stacked nav-quirk">
  <li{!! is_active('manager.dashboard', ' class="active"') !!}>
    <a href="{{ route('manager.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a>
  </li>
</ul>

<h5 class="sidebar-title">CMS</h5>
<ul class="nav nav-pills nav-stacked nav-quirk">
  <li class="{!! is_active(['manager.cms.page', 'manager.cms.page.update'], 'active ') !!}">
    <a href="{{ route('manager.cms.page') }}"><i class="fa fa-list"></i> <span>Pages</span></a>
  </li>
</ul>

<ul class="nav nav-pills nav-stacked nav-quirk">
  <li class="{!! is_active(['manager.users', 'manager.roles', 'manager.users.update', 'manager.roles.update'], 'active ') !!}nav-parent">
    <a href="#"><i class="fa fa-user"></i> <span>Users</span></a>
    <ul class="children">
      <li class="{!! is_active(['manager.users', 'manager.users.update'], 'active ') !!}">
        <a href="{{ route('manager.users') }}">User</a>
      </li>
      <li class="{!! is_active(['manager.roles', 'manager.roles.update'], 'active ') !!}">
        <a href="{{ route('manager.roles') }}">User Roles</a>
      </li>
    </ul>    
  </li>
  <li class="{!! is_active(['manager.configuration'], 'active ') !!}nav-parent">
    <a href="#"><i class="fa fa-gears"></i> <span>Settings</span></a>
    <ul class="children">
      <li>
        <a href="{{ route('manager.configuration', ['type' => 'general']) }}">General</a>
      </li>
    </ul>
  </li>
</ul>