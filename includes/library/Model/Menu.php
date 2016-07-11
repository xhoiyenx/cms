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
 * Menu model
 */

namespace Library\Model;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  /**
   * Menu children
   * @return Collection
   */
  public function sub()
  {
    return $this->hasMany(Menu::class, 'menu_parent');
  }

  /**
   * Menu parents
   * @return Collection
   */
  public function parent()
  {
    return $this->belongsTo(Menu::class, 'menu_parent');
  }

  /**
   * Modify default delete flow
   * @return void
   */
  public function delete()
  {
    # check if menu have children
    if ( ! $this->sub->isEmpty() ) {
      # let menu parent adopt the children
      foreach ( $this->sub as $child ) {
        $child->menu_parent = $this->menu_parent;
        $child->save();
      }
    }

    # delete the page
    parent::delete();
  }
}