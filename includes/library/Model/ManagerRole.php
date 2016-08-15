<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 1.0.0
 * Last Update: 09/07/2016
 *
 * Domain: 
 * Global
 * 
 * Type: 
 * Model
 * 
 * Description:
 * Manager Roles model
 */

namespace Library\Model;
use Illuminate\Database\Eloquent\Model;

class ManagerRole extends Model
{

  public function managers()
  {
    return $this->hasMany('Manager');
  }

  #############
  # MUTATORS  #
  #############
  public function getPermissionsAttribute( $value )
  {
    return explode(',', $value);
  }

}