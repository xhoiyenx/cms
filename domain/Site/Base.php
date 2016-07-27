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

use Library\Repository\Menu;

class Base extends Controller
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
    View::addLocation( public_path('themes/' . config('cms.theme')) );
    View::share('menu', $this->main_menu());
  }

  public function setPage( $text )
  {
    $this->page = $text;
    View::share('page', $this->page);
  }

  /**
   * Generate Menu
   */
  private function main_menu( $menu_type = 'main_menu' )
  {
    $menu = Menu::all(null, $menu_type, -1);

    $html = '<ul>';
    foreach ($menu as $item)
    {
      $html .= '<li>';
      $html .= '  <a href="'. $item->menu_link .'">';
      $html .= '    <div>'. $item->menu_name .'</div>';
      $html .= '  </a>';
      
      if ( ! $item->sub->isEmpty() ) {
        $submenu = $item->sub;
        $html .= '<ul>';
        foreach ( $submenu as $subitem ) {
          $html .= '<li>';
          $html .= '  <a href="'. $subitem->menu_link .'">';
          $html .= '    <div>'. $subitem->menu_name .'</div>';
          $html .= '  </a>';
          $html .= '</li>';
        }
        $html .= '</ul>';
      }

      $html .= '</li>';
    }
    $html .= '</ul>';

    return $html;
  }

  /**
   * 404 Page
   */
  public function error()
  {
    $this->page = '404';
    return response()->view('inc.404');
  }
}