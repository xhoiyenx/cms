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
 * Product taxonomy
 */

namespace Library\Repository;
use Library\Models\Taxonomy;

class ProductTaxonomy
{

  /**
   * Generate array of taxonomy tree
   * @param  string  $type   Taxonomy type
   * @param  integer $parent Taxonomy parent id
   * @param  array   $tree   Tree data
   * @return Tree array
   */
  public static function tree( $type, $parent = 0, $tree = [] )
  {
    $children = Taxonomy::where('parent', $parent)->where('type', $type)->orderBy('sort')->get();

    if ( ! $children->isEmpty() )
    {
      foreach( $children as $child )
      {
        $children = [
          'id'      => $child->id,
          'parent'  => $child->parent,
          'name'    => $child->name,
        ];

        if ( $sub = self::tree($type, $child->id) ) {
          $children['children'] = $sub;
        }
        else {
          $children['children'] = null;
        }
        
        $tree[] = $children;       
      }

      return $tree;
    }    
  }

  /**
   * Generate html select tree view
   * @param  string   $type     Taxonomy type
   * @param  Library\Models\Taxonomy  $selected Selected taxonomy class
   * @param  array    $tree     Tree data
   * @param  string   $html     Generated html
   * @param  integer  $level    Tree level
   * @return string Generated html
   */
  public static function selectTree( $type = 'category', $selected = null, $tree = null, $html = '', $level = 0 )
  {
    if ( $level == 0 AND $tree == null )
      $tree = self::tree($type);

    if ( $level == 0 ) {
      $html .= '<option value="0">Root</option>';
      $level++;
    }

    if ( count($tree) > 0 ) {

      foreach ( $tree as $child )
      {
        $pick   = '';
        if ( $selected != null ) {
          if ( $selected->parent == $child['id'] )
            $pick = ' selected';
        }

        if ( $level > 0 ) {
          if ( ! empty($selected) AND ($selected->id == $child['id'] OR $selected->id == $child['parent']) ) {

          }
          else {
            $html .= '<option value="'. $child['id'] .'"'.$pick.'>'. str_repeat('&nbsp;&nbsp;&nbsp;', $level) . $child['name'] .'</option>';
          }
        }
        else {
          $html .= '<option value="'. $child['id'] .'"'.$pick.'>'. $child['name'] .'</option>';
        }

        if ( $child['children'] != null ) {
          $html = self::selectTree( $type, $selected, $child['children'], $html, $level+1 );
        }
      }

    }

    return $html;
  }

  public static function checkboxTree( $type = 'category', $selected = [], $tree = null, $html = '', $level = 0 )
  {
    if ( $level == 0 AND $tree == null )
      $tree = self::tree($type);

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
          $html = static::checkboxTree($type, $selected, $child['children'], $html, $level);
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

  public static function checkboxList( $selected = [] )
  {
    $html   = '';
    $terms  = Taxonomy::where('parent', 0)->where('type', 'attribute')->orderBy('sort')->get();
    $available = [];

    if ( ! $terms->isEmpty() )
    {
      $html .= '<div class="cb-attributes">' . PHP_EOL;
      foreach ( $terms as $term )
      {
        $values = $term->children;
        if ( ! $values->isEmpty() ) {
          $available[] = $term;
          $html .= '<div>' . $term->name . '</div>' . PHP_EOL;
          $html .= '<ul class="checkbox-tree">' . PHP_EOL;

          foreach ( $values as $child ) {
            $checked = '';
            if ( in_array($child['id'], $selected) )
              $checked = ' checked="checked"';

            $html .= '<li>' . PHP_EOL;
            $html .= '  <label class="ckbox ckbox-primary">' . PHP_EOL;
            $html .= '    <input' .$checked. ' type="checkbox" name="attribute[]" value="' .$child['id']. '"><span>'. $child['name'] .'</span>' . PHP_EOL;
            $html .= '  </label>' . PHP_EOL;
            $html .= '</li>' . PHP_EOL;
          }

          $html .= '</ul>' . PHP_EOL;

        }

      }
      $html .= '</div>' . PHP_EOL;
    }

    return $html;
  }

  /**
   * Create list of all data of selected taxonomy
   * @param  string  $type   [description]
   * @param  integer $parent [description]
   * @param  array   $tree   [description]
   * @param  string  $name   [description]
   * @return [type]          [description]
   */
  public static function getCollection( $type = '', $parent = 0, $tree = [], $name = '' )
  {
    $taxonomies = Taxonomy::where('parent', $parent)->where('type', $type)->orderBy('sort')->get();

    if ( ! $taxonomies->isEmpty() )
    {
      foreach ( $taxonomies as $taxonomy ) {
        if ( $name != '' ) {
          $parent = $name;
          $name   = $name . ' > ' . $taxonomy->name;
        }
        else {
          $name = $taxonomy->name;
        }
        
        $data   = [
          'id'        => $taxonomy->id,
          'parent'    => $taxonomy->parent,
          'name'      => $name
        ];

        $tree[] = $data;

        if ( $child = static::getCollection($type, $taxonomy->id, $tree, $name) ) {
          $tree += $child;
        }
        $name = $parent;
      }

      return $tree;
    }
  }

  public static function getParents( $taxonomies = [] )
  {
    $query = Taxonomy::whereIn( 'id', $taxonomies)->groupBy('parent')->get();
    return $query;
  }
}