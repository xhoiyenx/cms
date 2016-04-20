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
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  protected $table = 'user';

  public function details()
  {
  	return $this->hasMany('Library\Models\UserDetail');
  }

  public function meta()
  {
  	return $this->hasMany('Library\Models\UserMeta');
  }

  public function role()
  {
  	return $this->belongsTo('Library\Models\UserRole');
  }
}