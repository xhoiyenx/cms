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
 * Product Category model
 */

namespace Library\Models;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
  protected $table = 'product_category';

  public function sub()
  {
    return $this->hasMany('Library\Models\ProductCategory', 'parent', 'id')->orderBy('sort_order');
  }

  public function products()
  {
    return $this->belongsToMany('Library\Models\Product', 'product_to_category', 'product_id', 'product_category_id');
  }  
}