<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 06/03/2016
 *
 * Domain: 
 * Global
 * 
 * Type: 
 * Model
 * 
 * Description:
 * Product model
 */

namespace Library\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'product';

  /**
   * Format price value
   * @param  decimal
   * @return mixed
   */
  public function getPriceAttribute($value)
  {
    return (int) $value;
  }

  /**
   * Have relations to product media
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function media()
  {
    return $this->hasMany('Library\Models\ProductMedia');
  }

  public function categories()
  {
    return $this->belongsToMany('Library\Models\ProductCategory', 'product_to_category', 'product_id', 'product_category_id');
  }

  public function categoriesArray()
  {
    return $this->categories->lists('id')->toArray();
  }

  public function getPrice()
  {
    return number_format( $this->price, 0, '.', '.' );
  }

  public function delete()
  {
    $this->media()->delete();
    $this->categories()->delete();
    parent::delete();
  }
}