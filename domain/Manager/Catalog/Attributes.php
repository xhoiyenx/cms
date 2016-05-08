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


class Attributes extends BaseController
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

    $this->setPage('Attribute Group');

    if ( $request->has('group') ){
      $parent = Taxonomy::find($request->group);

      if ( ! $parent ) {
        return redirect()->back()->withErrors('Attribute group not found');
      }

      $this->setPage('Attribute ' . $parent->name );
      $data = Taxonomy::where('parent', $request->group)->orderBy('sort')->paginate();
    }
    else {
      $this->setPage('Attribute Group');
      $data = Taxonomy::where('type', 'attribute')->where('parent', 0)->orderBy('sort')->paginate();
    }

    $view = [
      'list' => $data,
    ];

    return view()->make('catalog.attributes.index', $view);
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
      if ( $request->parent != 0 ) {
        $this->setPage('Attribute');
      }
      else {
        $this->setPage('Attribute Group');
      }

      if ( $request->has('id') ) {
        # update
        $edit = Taxonomy::find($request->id);
      }

      $view = [
        'edit' => $edit,
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
          return view('catalog.attributes.ajax-update', $view)->withErrors($validator);
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
          $data->type   = 'attribute';
          $data->sort   = $request->sort;
          $data->save();

          return 1;
        }
      }

      return view('catalog.attributes.ajax-update', $view);
    }
    else
    {
      # maybe show 404
      return abort(404);
    }
  }

  public function action( Request $request )
  {
    if ( $request->has('delete') )
    {
      $attributes = Taxonomy::findMany( $request->delete );
      if ( ! $attributes->isEmpty() ) {
        foreach ( $attributes as $attribute ) {
          $attribute->delete();
        }
      }

      return back()->withMessage('Item/s Deleted');
    }
    else {
      return back()->withMessage('Please select item');
    }
  }
}
