<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 05/03/2016
 *
 * Domain: 
 * Global
 * 
 * Type: 
 * Model
 * 
 * Description:
 * Administrators model
 */

namespace Library\Models;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	protected $table = 'user_role';

	public function users()
	{
		return $this->hasMany('Library\Models\User');
	}

	public function permissions()
	{
		return $this->hasMany('Library\Models\UserPermission');
	}
}