<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 15/03/2016
 *
 * Domain: 
 * System
 * 
 * Description:
 * Handle application installation or upgrade
 */
namespace Domain\System;

use Library\Classes\DatabaseSchema;

class App extends BaseController
{
	/**
	 * Show installation page
	 * @return view
	 */
	public function index()
	{
		return view('system.install');
	}

	public function install()
	{
		$schema = new DatabaseSchema;
		$schema->install();
	}

	public function upgrade()
	{
		$schema = new DatabaseSchema;
		$schema->upgrade();
	}
}
