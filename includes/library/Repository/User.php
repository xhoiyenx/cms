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

use Library\Models\User as UserModel;

class User
{
	static function get()
	{
		$list = UserModel::query();

		return $list->paginate();
	}

  static function find($id = null)
  {
    return UserModel::findOrNew($id);
  }  
}