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
use Library\Model\Page;

class Menu
{
  public static function getLinkType()
  {
    $type = [
      'link' => 'Link',
      'page' => 'Page'
    ];

    return $type;
  }

  public static function getDefaultMenu()
  {
    $menu = config('cms.menus');
    return key($menu);
  }

  public static function all( Request $request = null, $type = 'main_menu', $page = 20 )
  {
    $data = Model::query();

    if ( $request )
    {
      $data->where('menu_parent', $request->get('sub', 0));
    }
    else
    {
      $data->where('menu_parent', 0);
    }

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

  /**
   * Process link based on submitted link type and value
   * @param  [string] $link_type [link type as described on getLinkType]
   * @param  [string] $value     [submitted link value]
   * @return [string] processed link
   */
  public static function processLink( $link_type, $value )
  {
    # for link type [link and external_link] no need to process because as it is
    switch ($link_type) {
      # process CMS Page type
      case 'page':
        $page = Page::findOrNew($value);
        return $page->getLink();
        break;
      
      default:
        return $value;
        break;
    }
  }

  public static function menuTree( $type = null )
  {

  }

}