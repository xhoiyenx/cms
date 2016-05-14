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
use Library\Repository\ProductMediaRepo;

class Product extends BaseController
{

  /**
   * Show product list
   * @param  Request $request
   * @return View
   */
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
    $this->setPage('New Product');

    # new
    if ( empty( $product_id ) ) {
      $product  = ProductRepo::setDraft();
    }
    # update
    else {
      $product  = ProductRepo::getProduct( $product_id );
      $this->setPage($product->name);
    }

    $view = [
      'form'        => $product,
      'media'       => ProductMediaRepo::getByProduct( $product->id ),
      'categories'  => ProductTaxonomy::checkboxTree('category', $product->taxonomyArray('category'))
    ];

    return view()->make('catalog.products.update', $view);
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

    # validate
    $this->validate( $request, [
      'name' => 'required',
      'sku' => 'required'
    ]);

    # save product
    $product = ProductRepo::find( $request->id );
    $product->name        = $request->name;
    $product->description = $request->description;
    $product->sku         = $request->sku;
    $product->price       = $request->price;
    $product->use_stock   = $request->use_stock;
    $product->qty_stock   = $request->qty_stock ?: 0;
    $product->status      = 'published';
    $product->save();
    # end save product

    # save category
    $categories = [];
    if ( $request->has('category') ) {
      $categories = ProductRepo::syncTerms($request->category, 'category');
    }
    $product->categories()->sync($categories);
    # end save category

    if ( $product ) {
      return redirect()->route('manager.catalog.product.update', ['id' => $product->id])
      ->with('message', 'Product data saved');
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
