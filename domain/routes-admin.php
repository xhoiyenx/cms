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
# Catalog pages
#
$router->group(['namespace' => 'Catalog'], function($router) {

  # Categories
  $router->get('catalog/category', 'Categories@index')->name('catalog.categories');
  $router->post('catalog/category', 'Categories@save')->name('catalog.categories.save');

  # Products
  $router->get('catalog/product', 'Product@index')->name('catalog.product');
  $router->get('catalog/product/update/{id?}', 'Product@update')->name('catalog.product.update');
  $router->post('catalog/product/save', 'Product@save')->name('catalog.product.save');

});

#
# Media handler
#
$router->post('media/product/upload', 'MediaUpload@product')->name('media.product.upload');
