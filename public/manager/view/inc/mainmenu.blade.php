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
  <li><a href="{{ route('manager.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
</ul>

<ul class="nav nav-pills nav-stacked nav-quirk">
  <li class="nav-parent">
    <a href="#"><i class="fa fa-shopping-basket"></i> <span>Catalog</span></a>
    <ul class="children">
      <li>
        <a href="{{ route('manager.product.categories') }}">Categories</a>
      </li>
    </ul>
  </li>
</ul>

<ul class="nav nav-pills nav-stacked nav-quirk">
  <li class="nav-parent">
    <a href="#"><i class="fa fa-gears"></i> <span>Configuration</span></a>
    <ul class="children">
      <li>
        <a href="{{ route('manager.configuration') }}">General</a>
      </li>
    </ul>
  </li>
</ul>