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
use View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Library\Models\ProductCategory;

abstract class Base extends Controller
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
    View::addLocation( public_path('themes/honako/view') );
  }

  public function setPage( $text )
  {
    $this->page = $text;
    View::share('page', $this->page);
  }
}