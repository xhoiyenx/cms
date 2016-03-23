<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 23/03/2016
 *
 * Domain: 
 * Global
 *
 * Type:
 * Functions
 * 
 * Description:
 * Global functions
 */

function is_active( $route, $text = '' )
{
	if ( empty($route) )
		return false;

	$router = app('router');
	if ( is_array($route) ) {
		foreach($route as $name) {
			if ( $router->is($name) ) {
				if ( $text != '' ) {
					return $text;
				}
				else {
					return true;
				}
			}
		}
	}
	else {
		if ( $router->is($route) ) {
			if ( $text != '' ) {
				return $text;
			}
			else {
				return true;
			}
		}
	}

	return false;
}