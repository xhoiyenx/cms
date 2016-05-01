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

use Illuminate\Http\Request;
use Library\Repository\User;

class Users extends BaseController
{
  public function index()
  {
  	$this->setPage('Users');
  	
  	$view = [
  		'list' => User::get()
  	];
  	return view('user.index', $view);
  }

  public function update($id = null)
  {
    $form = User::find($id);

    if ($form->exists) {
      $this->setPage('Edit User');
    }
    else {
      $this->setPage('Add New User');
    }

    $view = [
      'form'    => $form,
      'status'  => User::status(),
      'roles'   => User::roles()
    ];
    return view('user.update', $view);
  }

  public function save(Request $request)
  {
    if ($request->has('id'))
    {
      $this->validate($request, [
        'username' => 'required|max:25',
        'usermail' => 'required|max:50|email',
        'password' => 'confirmed'
      ]);
    }
    else
    {
      $this->validate($request, [
        'username' => 'required|max:25|unique:user',
        'usermail' => 'required|max:50|email|unique:user',
        'password' => 'required|confirmed'
      ]);
    }

    $user = User::save($request);
    if ( $user ) {
      return redirect()->route('manager.users.update', ['id' => $user->id])->with('message', 'Data updated');
    }
    else {
      return back()->withInput();
    }
  }
}
