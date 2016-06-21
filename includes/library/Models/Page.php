<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 14/06/2016
 *
 * Domain: 
 * Global
 * 
 * Type: 
 * Model
 * 
 * Description:
 * Page model
 */

namespace Library\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $table = 'page';

  /**
   * Page children
   * @return Collection
   */
  public function sub()
  {
    return $this->hasMany(Page::class, 'parent');
  }

  /**
   * Page parents
   * @return Collection
   */
  public function par()
  {
    return $this->belongsTo(Page::class, 'parent');
  }

  /**
   * Modify default delete flow
   * @return void
   */
  public function delete()
  {
    # check if page have children
    if ( ! $this->sub->isEmpty() ) {
      # let page parent adopt the children
      foreach ( $this->sub as $child ) {
        $child->parent = $this->parent;
        $child->save();
      }
    }

    # delete the page
    parent::delete();
  }
}