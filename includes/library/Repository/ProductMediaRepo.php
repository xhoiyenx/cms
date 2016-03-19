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

use Library\Models\ProductMedia;

class ProductMediaRepo
{
  static function getByProduct( $product_id )
  {
    $media = ProductMedia::where('product_id', $product_id)->orderBy('sort_order', 'asc')->get();
    return $media;
  }
}