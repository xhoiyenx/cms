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
use Library\Models\ProductMedia as ProductMediaModel;
use Library\Repository\ProductMediaRepo;

class ProductMedia extends BaseController
{
  public function update( Request $request )
  {
    $edit     = null;
    $errors   = array();
    $fileinfo = null;

    if ( $request->ajax() )
    {
      # save is initiated
      if ( $request->has('save') ) {
        
        # when saving, if current request is an update
        if ( $request->action == 'update' ) {

          $media = ProductMediaModel::find($request->id);

          #if user upload a file, process it
          if ( $request->hasFile('media') ) {
            $fileinfo = app('media')->handle( $request->file('media') );
          }

        }
        # insert new
        else {

          $media = new ProductMediaModel;
          $media->product_id = $request->id;

          # check if any file uploaded
          if ( ! $request->hasFile('media') ) {
            $errors[] = 'Please add file';
          }
          # file is uploaded, send it to Media handler
          else {
            $fileinfo = app('media')->handle( $request->file('media') );
          } # file uploaded

        }

        # process the data
        if ( empty($errors) )
        {

          $media->name = $request->name;
          $media->sort_order = $request->sort_order;
          if ( $fileinfo ) {
            $media->link = $fileinfo['link'];
            $media->mime = $fileinfo['mime'];
          }
          $media->save();
          return 1;

        }
        
      } # end has('save')

    } # request is ajax

    if ( $request->action == 'delete' ) {
      $delete = ProductMediaModel::find( $request->id );
      if ( $delete ) {
        $delete->delete();
      }
      return 1;
    }

    if ( $request->action == 'update' ) {
      $edit = ProductMediaModel::find( $request->id );
    }    

    $view = [
      'edit' => $edit
    ];

    return view()->make('catalog.media.update', $view)->withErrors( $errors );
  }

  public function mediaList(Request $request)
  {
    if ( $request->ajax() )
    {

      $view = [
        'media' => ProductMediaRepo::getByProduct( $request->id )
      ];

      return view()->make('catalog.media.list', $view);
    }
  }
}
