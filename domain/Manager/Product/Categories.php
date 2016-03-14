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
 * Product Category page
 */
namespace Domain\Manager\Product;

use Illuminate\Http\Request;
use Domain\Manager\BaseController;
use Library\Models\ProductCategory;

class Categories extends BaseController
{
  public function index()
  {
    $data = ProductCategory::get();

    $view = [
      'list' => $data
    ];

    return view()->make('catalog.categories.index', $view);
  }

  public function save(Request $request)
  {

    $this->validateWithBag('SaveCategory', $request, [
      'name' => 'required',
    ]);

    $data = new ProductCategory;
    $data->name = $request->get('name');
    $data->save();

    return back()->withMessage('Category saved');

  }
}
