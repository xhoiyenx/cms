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
use Library\Models\User as UserModel;
use Library\Models\UserDetail;
use Library\Repository\UserRole;

class User
{
  static function status()
  {
    return [
      'active'    => 'Active',
      'disabled'  => 'Disabled',
      'blocked'   => 'Blocked'
    ];
  }

  static function roles()
  {
    return UserRole::get()->lists('name', 'id');
  }

	static function get()
	{
		$list = UserModel::query();

		return $list->paginate();
	}

  static function find($id = null)
  {
    return UserModel::findOrNew($id);
  }

  static function save(Request $request)
  {
    $user = static::find($request->id);
    
    # set known parameters
    $user->usermail = $request->usermail;
    $user->status   = $request->status;
    $user->role_id  = $request->role_id;

    # if username not exists, create username from usermail
    # this case exists when user is registering from front site
    if ( ! $request->has('username') ) {
      $user->username = str_slug( $request->usermail );
    }
    else {
      $user->username = $request->username;
    }

    # if new user, create registration key
    if ( ! $user->exists ) {
      $user->registration_key = bcrypt( $request->usermail );
    }

    # if user password is defined
    if ( $request->has('password') ) {
      $user->password = bcrypt( $request->password );
    }

    # save base user data
    $user->save();

    # save user information
    if ( $request->has('general') )
      $detail = static::saveDetail($request->general, $user, 'general');

    return $user;
  }

  static function saveDetail( $data = [], UserModel $user, $type = 'general' )
  {
    $detail = $user->detail( $type );
    $detail->fullname = $data['fullname'];
    $detail->company  = $data['company'];
    $detail->address  = $data['address'];
    $detail->region   = $data['region'];
    $detail->city     = $data['city'];
    $detail->phone    = $data['phone'];
    $detail->mobile   = $data['mobile'];
    $detail->fax      = $data['fax'];

    if ( $detail->save() ) {
      return $detail;
    }
  }
}