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
 * All product interaction here
 */

namespace Library\Repository;

use Library\Models\Product;

class ProductRepo
{
  /**
   * Create draft product
   * @return Library\Models\Product
   */
  static function setDraft()
  {
    # check if any product on draft status
    $product = self::getDraft();

    if ( empty($product) ) {
      $product = new Product;
      $product->name  = '';
      $product->price = 0;
      $product->save();
    }

    return $product;
  }

  /**
   * Get single draft product
   * @return Library\Models\Product
   */
  static function getDraft()
  {
    $product = Product::where('status', 'draft')->first();

    return $product;
  }

  static function setProduct( $param )
  {
    extract($param);
    $product = Product::find($id);
    
    if ( $product )
    {
      $product->name    = $name;
      $product->price   = $price;
      $product->status  = 'published';
      $product->save();

      if ( isset($category) ) {
        $product->categories()->sync($category);
      }
    }

    return $product;
  }

  static function getProduct( $id )
  {
    $product = Product::find($id);
    return $product;
  }

  /**
   * Get all data
   * @return Collection
   */
  static function getData( $perPage = 20 )
  {
    $product = Product::query();
    $product->where('status', 'published');

    $data = $product->paginate($perPage);
    $data->setPath('');

    return $data;
  }
}
