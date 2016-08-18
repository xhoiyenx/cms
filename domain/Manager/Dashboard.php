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
 * Dashboard page
 */

namespace Domain\Manager;
use Illuminate\Http\Request;
use Event;

class Dashboard extends BaseController
{
  public function init(Request $request = null)
  {
    $this->view['page'] = 'Dashboard';

    Event::listen('admin.menu', function($menu) {

      $menu[20] = ['foo'];

      return $menu;

    }, 10);

    Event::listen('admin.menu', function($menu) {

      $menu[30] = ['foo'];

      return $menu;

    }, 15);
  }
  
  public function index()
  {
    # test filter
    


    return view('dashboard');
  }
}
