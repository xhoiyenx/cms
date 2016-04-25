<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 14/04/2016
 *
 * Domain: 
 * Manager
 * 
 * Type: 
 * Controller
 * 
 * Description:
 * Product variation
 */
namespace Domain\Manager\Catalog;

use Illuminate\Http\Request;
use Domain\Manager\BaseController;
use Library\Repository\ProductRepo;

class ProductVariation extends BaseController
{
  public function update( Request $request )
  {
    # if not ajax, abort
    if ( ! $request->ajax() )
      return abort(404);

    # if product id not exists, abort
    if ( ! $request->has('id') )
      return abort(404);

    $product = ProductRepo::find( $request->id );
    $variant = ProductRepo::find( $request->variant );

    $view = [
      'product' => $product,
      'form'    => $variant
    ];

    if ( empty($product->attributes) ) {
      $request->session()->flash('message', 'Please assign product attributes!');
    }

    return view('catalog.products.ajax-variation', $view);
  }
}