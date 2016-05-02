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

use Domain\Manager\BaseController;


use Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Library\Models\Taxonomy;
use Library\Repository\ProductTaxonomy;


class Categories extends BaseController
{
  public function index(Request $request)
  {

    # delete request
    if ( $request->delete ) {
      $delete = Taxonomy::find($request->delete);
      if ( $delete ) {
        $delete->delete();
      }
      return back()->withMessage($delete->name . ' Deleted');
    }

    $this->setPage('Categories');

    $data = array();

    # create pagination from Collection
    $coll = collect(ProductTaxonomy::getCollection('category'));
    $page = $request->page ?: 1;

    $data = new LengthAwarePaginator($coll->forPage($page, 1), $coll->count(), 1, null, [
              'path' => Paginator::resolveCurrentPath(),
              'pageName' => 'page'
            ]);

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
        $edit = Taxonomy::find($request->id);
      }

      $view = [
        'edit' => $edit,
        'tree' => ProductTaxonomy::selectTree('category', $edit)
      ];

      # user click save
      if ( ! is_null($request->name) )
      {
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
            $data = Taxonomy::find($request->id);
          }
          else {
            # insert
            $data = new Taxonomy;
          }

          $data->parent = $request->parent;
          $data->name   = $request->name;
          $data->slug   = str_slug( $request->name );
          $data->type   = 'category';
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
