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


#
# Default pages
#
$router->group(['namespace' => 'App'], function($router) {
  $router->get('/', 'Dashboard@index')->name('dashboard');
  $router->any('login', 'Authentication@login')->name('login'); # login page
  $router->get('logout', 'Authentication@logout')->name('logout'); #logout page
});


#
# Media
# 
$router->group(['namespace' => 'Media', 'prefix' => 'media', 'as' => 'media.'], function($router) {
  $router->post('upload/{type}', 'Upload@index')->name('upload');
});


#
# Configuration pages
#
$router->group(['namespace' => 'Config'], function($router) {
  $router->any('configuration/{type?}', 'Configuration@index')->name('configuration');
});



#
# CMS
#
$router->group(['namespace' => 'Cms', 'prefix' => 'cms', 'as' => 'cms.'], function($router) {

  #
  # PAGES
  #
  $router->any('pages', 'Pages@index')->name('page');
  $router->get('pages/create', 'Pages@form')->name('page.create');
  $router->get('pages/{page}/update', 'Pages@form')->name('page.update');
  $router->post('pages/save', 'Pages@save')->name('page.save');

  #
  # MENUS
  #
  $router->any('menus', 'Menus@index')->name('menu');
  $router->any('menus/create', 'Menus@form')->name('menu.create');
  $router->get('menus/{menu}/update', 'Menus@form')->name('menu.update');
  $router->post('menus/save', 'Menus@save')->name('menu.save');
  $router->post('menus/ajax', 'Menus@ajax')->name('menu.ajax');

});

#
# CATALOG
#
$router->group(['namespace' => 'Catalog', 'prefix' => 'catalog', 'as' => 'catalog.'], function($router) {

  #
  # PRODUCTS
  #
  $router->any('product', 'ProductsController@index')->name('product');

});

#
# CATALOG
#
$router->group(['namespace' => 'User', 'prefix' => 'user', 'as' => 'user.'], function($router) {

  #
  # ADMINISTRATORS
  #
  $router->any('administrator', 'ManagersController@index')->name('administrator');
  $router->any('administrator/roles', 'ManagerRolesController@index')->name('administrator.roles');

});