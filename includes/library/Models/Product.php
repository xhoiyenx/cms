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
use DB;

class Product extends Model
{
  protected $table = 'product';

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
      case 'attributes':
        return $this->attributes()->lists('id')->toArray();
        break;

      case 'variations':
        return $this->variations()->lists('id')->toArray();
        break;
      
      default:
        return $this->categories()->lists('id')->toArray();
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

  public function haveMultiAttributes()
  {
    $query = DB::table('product_term_relation');
    $query->select(DB::raw('COUNT(product_term.parent) AS multi'));
    $query->join('product_term', 'product_term.id', '=', 'product_term_relation.term_id');
    $query->where('product_term_relation.type', '=', 'attribute');
    $query->where('product_term_relation.product_id', '=', $this->id);
    $query->groupBy( 'product_term.parent' );
    $query->orderBy( 'multi', 'desc' );
    $data = $query->first();
    
    if ( $data->multi > 1 ) {
      return true;
    }
    else {
      return false;
    }
  }

  public function attributeGroups()
  {
    $product = $this;
    $groups = Taxonomy::with('children')->select('*')->whereIn( 'id', function($query) use ($product) {
      $query->selectRaw('parent FROM product_term WHERE id IN( SELECT term_id FROM product_term_relation WHERE product_id = ? ) AND type = ? GROUP BY parent', [$product->id, 'attribute']);
    })->orderBy('sort');

    return $groups->get();
  }

  /**
   * Mutators
   */
  
  /**
   * Format quantity value
   * @param  mixed
   * @return integer
   */  
  public function getQtyStockAttribute($value)
  {
    return intval($value);
  }

  /**
   * Format price value
   * @param  decimal
   * @return integer
   */
  public function getPriceAttribute($value)
  {
    return intval($value);
  }

}