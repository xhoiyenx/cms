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
 * Catalog Products
 */
namespace Domain\Manager\Catalog;

use Domain\Manager\BaseController;

class ProductsController extends BaseController
{
  public function index()
  {
    return view('catalog.products.list');
  }
}