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
      $this->setPage('Edit role');
    }
    else {
      $this->setPage('Add new role');
    }
    
    $view = [
      'form' => $form
    ];
    return view('user.update', $view);
  }  
}
