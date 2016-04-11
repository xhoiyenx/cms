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
 * Product Taxonomy model
 */

namespace Library\Models;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
  protected $table = 'product_term';

  /*
  public function sub()
  {
    return $this->hasMany('Library\Models\Taxonomy', 'parent', 'id');
  }

  public function products()
  {
    return $this->belongsToMany('Library\Models\Product', 'product_to_category', 'product_category_id', 'product_id');
  }

  public function delete()
  {
    # category have children
    if ( ! $this->sub->isEmpty() ) {
      # let category parent adopt the children
      foreach ( $this->sub as $child ) {
        $child->parent_id = $this->parent_id;
        $child->save();
      }
    }

    # category have assigned products
    if ( ! $this->products->isEmpty() ) {
      # detach all connection from products to this category
      $this->products()->sync([]);
    }

    # delete the category
    parent::delete();
  }
  */
}