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

use Library\Repository\ProductRepo;

class Product extends BaseController
{
  public function index(Request $request)
  {
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
    if ( empty( $product_id ) ) {
      $product  = ProductRepo::setDraft();
    }
    else {
      $product  = ProductRepo::getProduct( $product_id );
    }

    $view = [
      'form' => $product
    ];

    return view()->make('catalog.products.create', $view);
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
    $product = ProductRepo::setProduct( $request->all() );
    if ( $product ) {
      return redirect()->route('manager.catalog.product');
    }
  }
}
