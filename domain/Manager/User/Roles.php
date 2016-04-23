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
use Library\Repository\UserRole;
use Library\Models\UserRole as Role;

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
    $this->setPage('Add New');

    if ( is_null($id) ) {
      $form = new Role;
    }
    else {
      $form = Role::find($id);
    }
    
    $view = [
      'form' => $form
    ];
    return view('user.roles.update', $view);
  }

  public function save(Request $request)
  {
    dump($request->all());
  }
}