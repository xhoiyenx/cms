<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 16/03/2016
 *
 * Domain: 
 * Library
 * 
 * Type: 
 * Repository
 * 
 * Description:
 * Menu repository
 */

namespace Library\Repository;

use Illuminate\Http\Request;
use Library\Model\Menu as Model;

class Menu
{
  public static function getMenuType()
  {
    $type = [
      'link' => 'Link',
      'external_link' => 'External Link',
      'page' => 'Page'
    ];

    return $type;
  }

  public static function getDefaultMenu()
  {
    $menu = config('cms.menus');
    return key($menu);
  }

  public static function all( Request $request = null, $type = 'page', $page = 20 )
  {
    $data = Model::query();

    $data->where('menu_parent', $request->get('sub', 0));

    # default sort
    $data->orderBy('sort');
    $data->orderBy('id');

    if ( $page == '-1' ) {
      $list = $data->get();
    }
    else {
      $list = $data->paginate($page);
      $list->setPath('');
    }

    return $list;
  }

  public static function menuTree( $type = null )
  {

  }

}