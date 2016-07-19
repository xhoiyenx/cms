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
 * All product media functions
 */

namespace Library\Repository;

use Illuminate\Http\Request;
use Library\Model\Page as Model;

class Page
{
  static function all( Request $request = null, $type = 'page', $page = 20 )
  {
    $data = Model::query();

    # handle parameters here
    if ( $request->has('search') ) {
      $data->where('page_name', 'LIKE', '%'. $request->search .'%');
    }

    $data->where('page_parent', $request->get('sub', 0));

    $data->where('page_type', $type);

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

  static function slug( $string, $id = null )
  {
    $slug = str_slug($string);

    $i = 1;

    $query = Model::query();

    if ( !empty($id) ) {
      $query->where('id', '<>', $id);
    }

    while ( $check = $query->where('page_slug', $slug)->count() ) {
      if ($i >= 10) {
        break;
      }
      $slug = str_slug($string) . '-' . $i;
      $i++;
    }

    return $slug;
  }

  static function getList( $type = 'page' )
  {

  }

}