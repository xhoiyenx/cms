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
use Library\Repository\ProductTaxonomy;

class ProductVariation extends BaseController
{
  public function update( Request $request )
  {
    $success = true;

    # if not ajax, abort
    if ( ! $request->ajax() )
      return abort(404);

    # if product id not exists, abort
    if ( ! $request->has('id') )
      return abort(404);

    $product = ProductRepo::find( $request->id );
    $variant = ProductRepo::find( $request->variant );

    if ( $product->attributes->isEmpty() ) {
      $success = false;
      $request->session()->flash('message', 'Please assign product attributes!');
    }
    elseif ( ! $product->haveMultiAttributes() ) {
      $success = false;
      $request->session()->flash('message', 'Please assign more than one product attribute values!');
    }

    $view = [
      'product' => $product,
      'form'    => $variant,
      'success' => $success
    ];

    return view('catalog.products.ajax-variation', $view);
  }

  public function save()
  {
    
  }
}