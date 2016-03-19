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
use Library\Models\ProductCategory;
use Library\Models\ProductToCategory;

class ProductCategoryRepo
{
  static function getByProduct( $product_id )
  {
    $media = ProductMedia::where('product_id', $product_id)->orderBy('sort_order', 'asc')->get();
    return $media;
  }

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

  public static function selectTree( $selected = 0, $tree = null, $html = '', $level = 0 )
  {
    if ( $level == 0 AND $tree == null)
      $tree = self::getTree();

    $id     = isset( $tree['id'] ) ? $tree['id'] : 0;
    $name   = isset( $tree['name'] ) ? $tree['name'] : 0;
    $child  = isset( $tree['children'] ) ? $tree['children'] : null;

    if ( $level > 0 )
      $html .= '<option value="'. $id .'">'. str_repeat('&nbsp;&nbsp;&nbsp;', $level) . $name .'</option>';
    else
      $html .= '<option value="'. $id .'">'. $name .'</option>';
    if ( $child != null ) {
      $level++;
      foreach ( $child as $children ) {
        $html = self::selectTree( $selected, $children, $html, $level );
      }
    }

    return $html;
  }  
}