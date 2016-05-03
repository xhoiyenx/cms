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

use Illuminate\Http\Request;
use Library\Classes\DatabaseSchema;

class App extends BaseController
{
	/**
	 * Show installation page
	 * @return view
	 */
	public function index()
	{
		$view = [
			'timezones' => timezone_identifiers_list()
		];
		return view('system.install', $view);
	}

	public function install()
	{
		return back()->withInput();
	}

	public function upgrade()
	{
		$schema = new DatabaseSchema;
		$schema->upgrade();
	}
}
