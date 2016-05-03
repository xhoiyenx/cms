<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 28/02/2016
 *
 * Domain: 
 * System
 * 
 * Type: 
 * Router
 * 
 * Description:
 * All system routes assigned here
 */
$router->get('/', 'App@index');
$router->post('/', 'App@install')->name('install');

$router->get('upgrade', 'App@upgrade');
$router->get('test', 'Test@index');