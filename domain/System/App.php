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

use PDOException;
use Illuminate\Http\Request;
use Library\Classes\DatabaseSchema;
use Illuminate\Database\Connectors\MySqlConnector;

use Library\Models\User;
use Library\Models\UserRole;

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

	public function install( Request $request )
	{
		$app = app();

		# validate first
		$this->validate($request, [
			'dbname' 		=> 'required',
			'dbuser' 		=> 'required',
			'dbpass' 		=> 'required',
			'rolename' 	=> 'required',
			'username' 	=> 'required',
			'password' 	=> 'required',
		]);

		# all validation good
		# test connection to mysql
		$mysql = new MySqlConnector;
		$connection = null;

		try {
			$connection = $mysql->connect([
				'host' => $request->dbhost ?: 'localhost',
				'username' => $request->dbuser,
				'password' => $request->dbpass,
				'database' => $request->dbname,
				'collation' => 'utf8_general_ci',
				'charset' => 'utf8',
			]);
		}
		catch( PDOException $e) {
			$connection = null;
		}

		# connection fails, redirect with errors
		if ( is_null($connection) ) {
			return back()->withInput()->withErrors('There is a problem when connecting to your database, please check your database configuration');
		}

		# create environment file
		$this->setEnvFile($request);

		session(['accounts' => array(
			'rolename' => $request->rolename,
			'username' => $request->username,
			'password' => $request->password
		)]);

		return redirect()->route('system.setup');
	}

	private function setEnvFile(Request $request)
	{
		$env  = 'APP_ENV=production' . PHP_EOL;
		$env .= 'APP_DEBUG=false' . PHP_EOL;
		$env .= 'APP_KEY=' . base64_encode(random_bytes(32)) . PHP_EOL;

		$host = $request->dbhost ?: 'localhost';
		$env .= 'DB_HOST=' . $host  . PHP_EOL;
		$env .= 'DB_NAME=' . $request->dbname . PHP_EOL;
		$env .= 'DB_USER=' . $request->dbuser . PHP_EOL;
		$env .= 'DB_PASS=' . $request->dbpass . PHP_EOL;

		$env .= 'TIMEZONE=' . $request->timezone . PHP_EOL;

		# create environment file
		$fp = fopen('.env', 'w');
		fwrite($fp, $env);
		fclose($fp);
	}

	public function setup()
	{
		# install database
		$schema = new DatabaseSchema;
		$schema->install();

		# create administrator role
		$accounts = session('accounts');

		$role = new UserRole;
		$role->name = $accounts['rolename'];
		$role->is_admin = 1;
		$role->save();

		$user = new User;
		$user->username = $accounts['username'];
		$user->password = bcrypt($accounts['password']);
		$user->usermail = '';
		$user->status 	= 'active';
		$user->role_id 	= $role->id;
		$user->save();

		return redirect()->route('manager.login');
	}

	public function upgrade()
	{
		$schema = new DatabaseSchema;
		$schema->upgrade();
	}
}
