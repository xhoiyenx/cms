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

abstract class BaseController extends Controller
{
  use ValidatesRequests;
  
  public function __construct()
  {
    $this->init();
  }

  /**
   * Set framework settings for manager domain
   * @return void
   */
  private function init()
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
  }

  protected function variables()
  {

  }
}