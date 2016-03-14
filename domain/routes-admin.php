<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 28/02/2016
 *
 * Domain: 
 * Manager
 * 
 * Type: 
 * Router
 * 
 * Description:
 * All administrator routes assigned here
 */
$router->get('/', function(){
  return 'foo';
});

#
# Dashboard
#
$router->get('/', 'Dashboard@index')->name('dashboard');

#
# Auth pages
#
$router->group(['namespace' => 'Auth'], function($router) {
  $router->any('login', 'Authentication@login')->name('login'); # login page
  $router->get('logout', 'Authentication@logout')->name('logout'); #logout page
});

#
# Configuration pages
#
$router->group(['namespace' => 'Config'], function($router) {
  $router->any('configuration/{type?}', 'Configuration@index')->name('configuration');
});

#
# Configuration pages
#
$router->group(['namespace' => 'Product'], function($router) {
  $router->get('product/category', 'Categories@index')->name('product.categories');
  $router->post('product/category', 'Categories@save')->name('product.categories.save');
});