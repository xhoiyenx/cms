<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 16/03/2016
 *
 * Domain: 
 * Library
 * 
 * Type: 
 * Repository
 * 
 * Description:
 * All product media functions
 */

namespace Library\Repository;

use Library\Models\UserRole as UserRoleModel;

class UserRole
{
  static function get()
  {
    $list = UserRoleModel::query();

    return $list->paginate();
  }
}