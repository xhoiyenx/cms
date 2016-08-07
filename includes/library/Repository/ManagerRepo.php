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
 * Manager repository
 */

namespace Library\Repository;

use Illuminate\Http\Request;
use Library\Model\Manager as Model;

class ManagerRepo
{
  static function all( $page = 20 )
  {
    $data = Model::query();

    # default sort
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
}