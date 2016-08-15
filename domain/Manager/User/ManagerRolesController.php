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
  private $permissions = [
    [
      'title' => 'Administrators',
      'value' => [
        'ManagersController' => 'Administrators',
        'ManagerRolesController' => 'Administrator Roles',
      ]
    ]
  ];

  protected function init(Request $request = null)
  {

    # on submit
    if ( $request->isMethod('POST') ) {
      # save request
      if ( $request->has('save') ) {
        $this->save($request);
      }
    }

    $this->view += [
      'page' => 'Administrator Roles',
      'form' => ManagerRole::findOrNew($request->get('edit')),
      'list' => ManagerRoleRepo::all(),
      'perm' => $this->permissions
    ];

  }

  public function index(Request $request)
  {
    return view('user.administrator.role');
  }

  private function save($request)
  {

    $role = ManagerRole::findOrNew($request->get('edit'));
    $this->validate($request, [
      'manager_name' => 'required'
    ]);

    $role->manager_name = $request->manager_name;
    $role->is_admin     = $request->get('is_admin', 0);

    if ( $request->permissions )
      $role->permissions  = implode(',', $request->permissions);

    $role->save();

    redirect()->to($request->url())->with('message', 'Administrator role data saved')->send();

  }
}