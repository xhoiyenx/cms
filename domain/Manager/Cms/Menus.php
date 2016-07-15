<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 09/03/2016
 *
 * Domain: 
 * Manager
 * 
 * Type: 
 * Controller
 * 
 * Description:
 * CMS Menus page
 */
namespace Domain\Manager\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use Domain\Manager\BaseController;
use Library\Model\Menu;
use Library\Repository\Menu as MenuRepo;
use Library\Repository\Page as PageRepo;


class Menus extends BaseController
{

  public function index()
  {
    return view('cms.menus.list');
  }

  public function form(Request $request, Menu $menu = null)
  {
    $this->setPage('Create Menu');

    if ( !$menu->exists ) {

    }

    # assign default menu
    if ( !$request->has('menu') ) {
      $type = config('cms.menus');
      $menu->menu_type = key($type);
    }

    $view = [
      'form' => $menu,
      'menu_type' => MenuRepo::getMenuType()
    ];

    return view('cms.menus.form', $view);

  }

}