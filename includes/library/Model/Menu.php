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

use DB;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $appends = ['meta'];

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

    # delete menu meta
    DB::table('menus_meta')->where('menu_id', $this->id)->delete();

    # delete the menu
    parent::delete();
  }

  #############
  # MUTATORS  #
  #############
  public function getSortAttribute( $value )
  {
    return (int) $value;
  }

  public function getMetaAttribute()
  {
    return DB::table('menus_meta')->where('menu_id', $this->id)->lists('meta_val', 'meta_key');
  }
}