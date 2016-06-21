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
use Library\Models\Page as Model;

class Page
{
  static function all( Request $request = null, $page = 20 )
  {
    $data = Model::query();

    # handle parameters here
    if ( $request->has('search') ) {
      $data->where('name', 'LIKE', '%'. $request->search .'%');
    }

    if ( $request->has('parent') ) {
      $data->where('parent', $request->parent);
    }
    else {
      $data->where('parent', 0);
    }

    # default sort
    $data->orderBy('sort');
    $data->orderBy('id');


    $list = $data->paginate($page);
    $list->setPath('');

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

    while ( $check = $query->where('slug', $slug)->count() ) {
      if ($i >= 10) {
        break;
      }
      $slug = str_slug($string) . '-' . $i;
      $i++;
    }

    return $slug;
  }

}