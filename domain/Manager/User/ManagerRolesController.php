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
use Library\Repository\ManagerRoleRepo;

class ManagerRolesController extends BaseController
{
  protected function init()
  {

    $request = request();
    # on submit
    if ( $request->isMethod('POST') ) {
      # save request
      if ( $request->has('save') ) {
        $this->save($request);
      }
    }

  }

  public function index(Request $request)
  {
    $this->setPage('Administrator Roles');

    $this->view += [
      'form' => ManagerRole::findOrNew($request->get('edit')),
      'list' => ManagerRoleRepo::all(),
    ];

    return view('user.administrator.role', $this->view);
  }

  private function save($request)
  {

    $role = ManagerRole::findOrNew($request->get('edit'));
    $this->validate($request, [
      'manager_name' => 'required'
    ]);

    $role->manager_name = $request->manager_name;
    $role->is_admin = $request->get('is_admin', 0);
    $role->save();

    $request->session()->flash('message', 'Administrator role data saved');

  }
}