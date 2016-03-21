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
namespace Domain\Manager\Catalog;

use Illuminate\Http\Request;
use Domain\Manager\BaseController;
use Library\Models\ProductCategory;
use Library\Repository\ProductCategoryRepo;

class Categories extends BaseController
{
  public function index( $category_id = null )
  {
    $coll = collect(ProductCategoryRepo::getColl());
    $edit = null;

    if ( $category_id ) {
      $edit = ProductCategory::find($category_id);
    }

    $view = [
      'list' => $coll,
      'edit' => $edit
    ];

    return view()->make('catalog.categories.index', $view);
  }

  public function save(Request $request)
  {

    $this->validateWithBag('SaveCategory', $request, [
      'name' => 'required',
    ]);

    if ( $request->has('id') ) {
      # update
      $data = ProductCategory::find($request->get('id'));
    }
    else {
      # insert
      $data = new ProductCategory;
    }

    $data->parent_id = $request->get('parent_id');
    $data->name = $request->get('name');
    $data->save();

    return redirect()->route('manager.catalog.categories')->withMessage('Category saved');

  }
}
