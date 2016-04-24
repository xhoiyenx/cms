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

use Illuminate\Http\Request;
use Library\Models\UserRole as UserRoleModel;
use Library\Models\UserPermission;

class UserRole
{
  static function get()
  {
    $list = UserRoleModel::query();

    return $list->paginate();
  }

  static function find($id = null)
  {
    return UserRoleModel::findOrNew($id);
  }

  static function save(Request $request)
  {
    # update
    if ( $request->has('id') ) {
      $role = UserRoleModel::find($request->id);
    }
    # insert
    else {
      $role = new UserRoleModel;
    }

    $role->name = $request->name;
    $role->save();

    # save permissions
    $permissions = $role->permissions;

    $r_permissions = $request->permissions ?:[];

    # permissions still empty, add all of them
    if ( $permissions->isEmpty() ) {
      foreach ( $r_permissions as $name => $active ) {
        $role->permissions()->save( new UserPermission(['permission' => $name]) ); 
      }
    }
    else {
      foreach ( $permissions as $permit ) {
        # permit revoked
        if ( ! array_key_exists($permit->permission, $r_permissions) ) {
          $permit->active = 0;
          $permit->save();
        }
        else {
          $permit->active = 1;
          $permit->save();
          unset($r_permissions[$permit->permission]);
        }
      }

      if ( ! empty($r_permissions) ) {
        foreach ( $r_permissions as $name => $active ) {
          $role->permissions()->save( new UserPermission(['permission' => $name]) ); 
        }
      }
    }

    return $role;

  }
}