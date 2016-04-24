<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 28/02/2016
 *
 * Domain: 
 * Manager
 * 
 * Description:
 * Users list page
 */

namespace Domain\Manager\User;
use Domain\Manager\BaseController;

use Validator;
use Illuminate\Http\Request;
use Library\Repository\UserRole;

class Roles extends BaseController
{
  public function index()
  {
  	$this->setPage('User Roles');
  	
  	$view = [
  		'list' => UserRole::get()
  	];
  	return view('user.roles.index', $view);
  }

  public function update($id = null)
  {
    $form = UserRole::find($id);

    if ($form->exists) {
      $this->setPage('Edit role');
    }
    else {
      $this->setPage('Add new role');
    }
    
    $view = [
      'form' => $form
    ];
    return view('user.roles.update', $view);
  }

  public function delete($id = null)
  {
    $role = UserRole::find($id);
    if ($role) {
      $role->delete();
      return back()->with('message', 'Role deleted');
    }
  }

  public function save(Request $request)
  {
    $id = '';
    if ( $request->has('id') ) {
      $id = ',' . $request->get('id');
    }

    #validate
    $validator = Validator::make($request->all(), [
      'name' => 'required|unique:user_role,name' . $id,
    ]);

    # validate fail
    if ( $validator->fails() ) {
      return back()->withErrors($validator);
    }
    # save data
    else {
      if ( $role = UserRole::save($request) ) {
        return redirect()->route('manager.roles.update', ['id' => $role->id])->with('message', 'Data saved');
      }
    }

  }
}