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
 * Product Media model
 */

namespace Library\Models;
use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
  protected $table = 'product_media';

  public function product()
  {
    return $this->belongsTo('Library\Models\Product');
  }

  /**
   * Delete media
   * @return
   */
  public function delete()
  {
    $media = app('media');
    if ( $media->delete( $this->link ) ) {
      parent::delete();
    }
  }
}