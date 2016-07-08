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

namespace Library\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  protected $table    = 'user';
  protected $appends  = ['general'];

  public function detail( $type = 'general' )
  {
  	return $this->hasOne('Library\Models\UserDetail')->firstOrNew( ['type' => $type] );
  }

  public function meta()
  {
  	return $this->hasMany('Library\Models\UserMeta');
  }

  public function role()
  {
  	return $this->belongsTo('Library\Models\UserRole');
  }

  public function getGeneralAttribute()
  {
    return $this->attributes['general'] = $this->detail()->toArray();
  }
}