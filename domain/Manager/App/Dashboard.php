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

namespace Domain\Manager\App;
use Domain\Manager\BaseController;
use Illuminate\Http\Request;

class Dashboard extends BaseController
{
  public function init(Request $request = null)
  {
    $this->view['page'] = 'Dashboard';
  }
  
  public function index()
  {
    # test filter
    return view('dashboard');
  }
}
