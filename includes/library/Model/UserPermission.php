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

class UserPermission extends Model
{
	protected $table = 'user_permission';
	public $timestamps = false;
  protected $fillable = ['permission', 'active'];

	public function role()
	{
		return $this->belongsTo('Library\Models\UserRole');
	}
}