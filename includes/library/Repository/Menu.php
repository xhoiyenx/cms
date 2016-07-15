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
      'page' => 'Page'
    ];

    return $type;
  }

}