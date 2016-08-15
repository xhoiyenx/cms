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
use Library\Model\Manager;
use Library\Model\ManagerRole;
use Library\Repository\ManagerRepo;

class ManagersController extends BaseController
{
  protected function init(Request $request = null)
  {
    
    # on submit
    if ( $request->isMethod('POST') ) {
      # save request
      if ( $request->has('save') ) {
        return $this->save($request);
      }
    }

    $this->view += [
      'page' => 'Administrators',
      'list' => ManagerRepo::all(),
      'role' => ManagerRole::pluck('manager_name', 'id'),
      'form' => Manager::findOrNew( $request->edit )
    ];

  }

  public function index(Request $request)
  {
    return view('user.administrator.list');
  }

  private function save($request)
  {

    $admin = Manager::findOrNew($request->get('edit'));

    if ($admin->exists)
    {
      # validate
      $this->validate($request, [
        'usermail' => 'required|email|unique:managers,usermail,' . $admin->id,
        'username' => 'required|unique:managers,username,' . $admin->id,
        'password' => 'sometimes|confirmed'
      ]);
    }
    else {
      # validate
      $this->validate($request, [
        'usermail' => 'required|email|unique:managers',
        'username' => 'required|unique:managers',
        'password' => 'required|confirmed'
      ]);
    }

    $admin->usermail = $request->usermail;
    $admin->username = $request->username;
    $admin->manager_role_id = $request->manager_role_id;

    if ( $request->has('password'))
      $admin->password = bcrypt($request->password);

    $admin->save();

    return redirect()->to($request->url())->with('message', 'Administrator data saved')->send();

  }
}