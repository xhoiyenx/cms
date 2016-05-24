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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Library\Models\ProductCategory;

abstract class BaseController extends Controller
{
  protected $page;
  protected $app;
  
  public function __construct(Application $app)
  {
    $this->init();
    $this->app    = $app;
  }

  /**
   * Set framework settings for manager domain
   * @return void
   */
  private function init()
  {
    # define default view path for manager
    view()->addLocation( public_path('themes/shop') );
  }

  public function setPage( $text )
  {
    $this->page = $text;
    view()->share('page', $this->page);
  }

  /**
   * Init global variables
   * @return void
   */
  public function global()
  {
    $categories = 
  }
}