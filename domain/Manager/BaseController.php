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
 * Base controller for Manager Domain
 */

namespace Domain\Manager;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
  use ValidatesRequests;

  protected $page;
  protected $view = [];
  protected $name;
  protected $menu;
  
  public function __construct()
  {
    # define default view path for manager
    view()->addLocation( public_path('manager/view') );

    # define default authentication guard
    auth()->shouldUse('manager');

    # all access is limited, except
    # 1. login page
    $this->middleware('auth', [
      'except' => [
        'login'
      ]
    ]);

    #global values
    $this->name = last( explode('\\', get_class($this)) );
    $this->view['permission_name'] = $this->name;

    $this->init(request());
    $this->view();
  }

  /**
   * Set framework settings for manager domain
   * @return void
   */
  private function view()
  {
    view()->share($this->view);
  }

  abstract protected function init(Request $request = null);
}