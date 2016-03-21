<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 16/03/2016
 *
 * Domain: 
 * Library
 * 
 * Type: 
 * Repository
 * 
 * Description:
 * All product category functions
 */

namespace Library\Repository;

use Illuminate\Support\Collection;
use Library\Models\ProductCategory;
use Library\Models\ProductToCategory;

class ProductCategoryRepo
{
  public static function getBreadcrumb( $category_id, $breadcrumb = [] )
  {
    $category = ProductCategory::find( $category_id );

    if ( $category ) {
      if ( $category->parent_id != 0 ) {
        $breadcrumb = self::getBreadcrumb($category->parent_id, $breadcrumb);
      }

      $breadcrumb[] = $category;
    }

    return $breadcrumb;
  }

  public static function getTree( $parent_id = 0, $tree = [] )
  {
    if ( empty($tree) ) {
      $tree = [
        'id' => '0',
        'parent_id' => null,
        'name' => 'Main Category'
      ];
    }

    $childrens = ProductCategory::where('parent_id', $parent_id)->get();

    if ( ! $childrens->isEmpty() )
    {
      foreach( $childrens as $children )
      {
        $child = [
          'id' => $children->id,
          'parent_id' => $children->parent_id,
          'name' => $children->name
        ];
        $tree['children'][] = self::getTree( $children->id, $child );
      }
    }
    else {
      $tree['children'] = null;
    }

    return $tree;
  }

  public static function selectTree( $selected = null, $tree = null, $html = '', $level = 0 )
  {
    if ( $level == 0 AND $tree == null)
      $tree = self::getTree();

    $id       = isset( $tree['id'] ) ? $tree['id'] : 0;
    $name     = isset( $tree['name'] ) ? $tree['name'] : 0;
    $child    = isset( $tree['children'] ) ? $tree['children'] : null;
    $parent   = isset( $tree['parent_id'] ) ? $tree['parent_id'] : null;

    $pick   = '';
    if ( $selected != null ) {
      if ( $selected->parent_id == $id )
        $pick = ' selected';
    }

    if ( $level > 0 ) {
      if ( ! empty($selected) AND ($selected->id == $id OR $selected->id == $parent) ) {

      }
      else {
        $html .= '<option value="'. $id .'"'.$pick.'>'. str_repeat('&nbsp;&nbsp;&nbsp;', $level) . $name .'</option>';
      }
    }
    else {
      $html .= '<option value="'. $id .'"'.$pick.'>'. $name .'</option>';
    }
    if ( $child != null ) {
      $level++;
      foreach ( $child as $children ) {
        $html = self::selectTree( $selected, $children, $html, $level );
      }
    }

    return $html;
  }

  public static function checkboxTree( $selected = [], $tree = null, $html = '', $level = 0 )
  {
    if ( $level == 0 AND $tree == null) {
      $tree = static::getTree();
      $tree = $tree['children'];
    }

    if ( ! empty($tree) )
    {
      if ( $html == '' ) {
        $html .= '<ul class="checkbox-tree">' . PHP_EOL;
      }
      else {
        $html .= '<ul>' . PHP_EOL;
      }

      $level++;
      foreach ( $tree as $child ) {
        $checked = '';
        if ( in_array($child['id'], $selected) )
          $checked = ' checked="checked"';

        $html .= '<li>' . PHP_EOL;
        $html .= '  <label class="ckbox ckbox-primary">' . PHP_EOL;
        $html .= '    <input' .$checked. ' type="checkbox" name="category[]" value="' .$child['id']. '"><span>'. $child['name'] .'</span>' . PHP_EOL;
        $html .= '  </label>' . PHP_EOL;

        if ( count($child['children']) > 0 ) {
          $html = static::checkboxTree($selected, $child['children'], $html, $level);
        }
        $html .= '</li>' . PHP_EOL;
      }
    }
    else {
      $html .= '</ul>' . PHP_EOL;
    }

    if ( $html != '' ) {
      $html .= '</ul>' . PHP_EOL;
    }

    return $html;
  }

  public static function getColl( $parent_id = 0, $tree = [], $name = '' )
  {
    $parent = '';
    $categories = ProductCategory::where('parent_id', $parent_id)->get();

    if ( ! $categories->isEmpty() )
    {
      foreach ( $categories as $category ) {
        if ( $name != '' ) {
          $parent = $name;
          $name   = $name . ' > ' . $category->name;
        }
        else {
          $name = $category->name;
        }
        
        $data   = [
          'id'        => $category->id,
          'parent_id' => $category->parent_id,
          'name'      => $name
        ];

        $tree[] = $data;

        if ( $child = static::getColl($category->id, $tree, $name) ) {
          $tree += $child;
        }
        $name = $parent;
      }

      return $tree;
    }
  }
}