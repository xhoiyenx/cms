<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 24/03/2016
 *
 * Domain: 
 * Public
 * 
 * Description:
 * Base controller for Public Domain
 */

namespace Domain\Site;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
  protected $page;
  
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
    view()->addLocation( public_path('honako/view') );
  }

  public function setPage( $text )
  {
    $this->page = $text;
    view()->share('page', $this->page);
  }
}