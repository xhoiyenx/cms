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

class ProductVariation extends BaseController
{
  public function update( Request $request )
  {
    if ( ! $request->ajax() )
      return abort(404);

    if ( ! $request->has('id') )
      return abort(404);

    $view = [];

    return view('catalog.products.ajax-variation', $view);
  }
}