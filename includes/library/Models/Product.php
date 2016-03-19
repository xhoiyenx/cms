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
}