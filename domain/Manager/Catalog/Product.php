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

class Product extends BaseController
{
  public function index()
  {
    $view = [

    ];

    return view()->make('catalog.products.index', $view);
  }

  public function create()
  {
    $view = [

    ];

    return view()->make('catalog.products.create', $view);
  }

  public function cancel( $product_id )
  {

  }

  public function save()
  {

  }
}
