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

use Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Domain\Manager\BaseController;
use Library\Models\ProductCategory;
use Library\Repository\ProductCategoryRepo;

class Categories extends BaseController
{
  public function index(Request $request)
  {
    # delete request
    if ( $request->delete ) {
      $delete = ProductCategory::find($request->delete);
      if ( $delete ) {
        $delete->delete();
      }
      return back()->withMessage($delete->name . ' Deleted');
    }

    $this->setPage('Categories');

    $data = null;

    # create pagination from Collection
    $coll = collect(ProductCategoryRepo::getColl());
    $page = $request->page ?: 1;

    if ( ! $coll->isEmpty() ) {
      $data = new LengthAwarePaginator($coll->forPage($page, 20), $coll->count(), 20, null, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page'
              ]);
    }

    $view = [
      'list' => $data,
    ];

    return view()->make('catalog.categories.index', $view);
  }

  /**
   * Update, only receive ajax request
   * @param  Request $request
   * @return 
   */
  public function update( Request $request )
  {
    $edit     = null;

    # only receive ajax request
    if ( $request->ajax() )
    {
      if ( $request->has('id') ) {
        # update
        $edit = ProductCategory::find($request->id);
      }

      $view = [
        'edit' => $edit
      ];

      # user click save
      if ( ! is_null($request->name) ) {
        #validate
        $validator = Validator::make($request->all(), [
          'name' => 'required',
        ]);

        # validate fail
        if ( $validator->fails() ) {
          return view('catalog.categories.ajax-update', $view)->withErrors($validator);
        }
        # validation success
        else {

          if ( $request->has('id') ) {
            # update
            $data = ProductCategory::find($request->id);
          }
          else {
            # insert
            $data = new ProductCategory;
          }

          $data->parent_id  = $request->parent_id;
          $data->name       = $request->name;
          $data->save();

          return 1;
        }
      }

      return view('catalog.categories.ajax-update', $view);
    }
    else
    {
      # maybe show 404
      return abort(404);
    }
  }
}
