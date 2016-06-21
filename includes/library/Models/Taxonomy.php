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

  public function children()
  {
    return $this->hasMany('Library\Models\Taxonomy', 'parent', 'id');
  }

  public function products()
  {
    return $this->belongsToMany('Library\Models\Product', 'product_term_relation', 'term_id');
  }

  public function attributeOf( Product $product )
  {
    $attributes = $product->attr->lists('id')->toArray();

    return $this->children->lists('name', 'id')->filter( function($value, $key) use($attributes) {
      return in_array($key, $attributes);
    });
  }

  public function delete()
  {
    # category have children
    if ( ! $this->children->isEmpty() ) {
      # let category parent adopt the children
      foreach ( $this->children as $child ) {
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
}