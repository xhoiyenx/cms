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
    return $this->belongsToMany('Library\Models\Taxonomy', 'product_term_relation', 'product_id', 'term_id')->where('product_term_relation.type', 'category')->wherePivot('type', '=', 'category');
  }

  public function attributes()
  {
    return $this->belongsToMany('Library\Models\Taxonomy', 'product_term_relation', 'product_id', 'term_id')->where('product_term_relation.type', 'attribute')->wherePivot('type', '=', 'attribute');
  }

  public function variationGroups()
  {
    return $this->belongsToMany('Library\Models\Taxonomy', 'product_term_relation', 'product_id', 'term_id')->where('product_term_relation.type', 'variation_groups')->wherePivot('type', '=', 'variation_groups');
  }  

  public function variations()
  {
    return $this->belongsToMany('Library\Models\Taxonomy', 'product_term_relation', 'product_id', 'term_id')->where('product_term_relation.type', 'variation')->wherePivot('type', '=', 'variation');
  }

  public function taxonomyArray( $type = 'categories' )
  {
    switch ($type) {
      case 'variations':
        return $this->variations->lists('id')->toArray();
        break;
      
      default:
        return $this->categories->lists('id')->toArray();
        break;
    }
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

  public function getImage( $size = 'thumb', $object = false )
  {
    $media = $this->media;
    if ( ! $media->isEmpty() ) {
      $image = $media[0];
      return app('media')->getMedia($image->link, $image->mime, $size);
    }
  }

  /**
   * Mutators
   */
  public function getQtyStockAttribute($value)
  {
      return intval($value);
  }  
}