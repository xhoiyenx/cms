<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 09/03/2016
 *
 * Domain: 
 * Manager
 * 
 * Type: 
 * Controller
 * 
 * Description:
 * Product page
 */
namespace Domain\Manager\Catalog;

use Illuminate\Http\Request;
use Domain\Manager\BaseController;


use Library\Models\Taxonomy;

use Library\Repository\ProductRepo;
use Library\Repository\ProductTaxonomy;

class Product extends BaseController
{
  public function index(Request $request)
  {
    $this->setPage('Products');
    
    $data = ProductRepo::getData();
    $view = [
      'list' => $data
    ];

    return view()->make('catalog.products.index', $view);
  }

  /**
   * Create new product page
   * @when access create new product, create new product data with draft status, and redirect it to updating data
   */
  public function update( $product_id = null )
  {
    $this->setPage('Add New Product');

    if ( empty( $product_id ) ) {
      $product  = ProductRepo::setDraft();
    }
    else {
      $product  = ProductRepo::getProduct( $product_id );
      $this->setPage($product->name);
    }

    $view = [
      'form' => $product,
    ];

    return view()->make('catalog.products.update.general', $view);
  }

  /**
   * Handling index lists actions, like delete, filter, search, etc
   * @return [type] [description]
   */
  public function action( Request $request )
  {

  }

  public function delete( $product_id = null )
  {
    $product  = ProductRepo::getProduct( $product_id );
    if ( $product ) {
      $product->delete();
    }

    return back()->with('message', 'Product Deleted');
  }

  public function save(Request $request)
  {
    # save ajax request here
    if ( $request->ajax() ) {
      return $this->ajaxSave($request);
    }

    $product = ProductRepo::setProduct( $request->all() );
    if ( $product ) {
      return redirect()->route('manager.catalog.product.update', ['id' => $product->id]);
    }
  }

  private function ajaxSave(Request $request)
  {
    switch ($request->action)
    {
      # assign attribute
      case 'attribute':
        $product = ProductRepo::getProduct( $request->id );
        $attributes = [];
        if ( ! empty($request->attribute) ) {
          $attributes = $request->attribute;
        }
        $product->attributes()->sync( ProductRepo::syncTerms($attributes, 'attribute') );
        #return $this->listAttributes( $attributes, $product->variationGroups->lists('id')->toArray() );
        return $this->listAttributes( $product );
        break;

      # get attributes
      case 'getAttributes':
        $product = ProductRepo::getProduct( $request->id );
        return $this->listAttributes( $product );
        #return $this->listAttributes( $product->attributes->lists('id')->toArray(), $product->variationGroups->lists('id')->toArray() );
        break;

      # assign attribute group as variation
      case 'variation_group':
        $product = ProductRepo::getProduct( $request->id );
        $attributes = [];
        if ( $request->has('attributes') ) {
          $attributes = $request->get('attributes');
        }
        $product->variationGroups()->sync( ProductRepo::syncTerms($attributes, 'variation_groups') );
        break;
    }
  }

  private function listAttributes( \Library\Models\Product $product )
  {
    $html   = '';
    $groups = $product->attributeGroups();

    if ( $groups->isEmpty() ) {
      $html .= '<tr>';
      $html .= '  <td colspan="2">Please assign product attributes to use variation.</td>';
      $html .= '</tr>';

      return $html;
    }

    foreach ($groups as $taxonomy)
    {
      $attributes = $taxonomy->attributeOf($product)->toArray();

      $html .= '<tr>';
      $html .= '  <td><strong>'. $taxonomy->name .'</strong></td>';
      $html .= '  <td>'. implode(', ', $attributes) .'</td>';
      $html .= '</tr>';
    }

    return $html;
  }
}
