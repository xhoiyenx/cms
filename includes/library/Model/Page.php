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

namespace Library\Model;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  /**
   * Page children
   * @return Collection
   */
  public function sub()
  {
    return $this->hasMany(Page::class, 'page_parent');
  }

  /**
   * Page parents
   * @return Collection
   */
  public function parent()
  {
    return $this->belongsTo(Page::class, 'page_parent');
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
        $child->page_parent = $this->page_parent;
        $child->save();
      }
    }

    # delete the page
    parent::delete();
  }
}