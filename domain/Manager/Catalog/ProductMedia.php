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
    $edit   = null;
    $errors = array();

    if ( $request->ajax() )
    {
      # save is initiated
      if ( $request->has('save') ) {
        
        # when saving, if current request is an update
        if ( $request->get('action') == 'update' ) {

          #if user upload a file, process it
          if ( $request->hasFile('media') ) {
          }

        }
        else {

          # check if any file uploaded
          if ( ! $request->hasFile('media') ) {
            $errors[] = 'Please add file';
          }
          # file is uploaded, send it to Media handler
          else {

            $fileinfo = app('media')->handle( $request->file('media') );

            # we got the file info, save it to database
            $media = new ProductMediaModel;
            $media->product_id = $request->get('product_id');
            $media->name = $request->get('name');
            $media->link = $fileinfo['link'];
            $media->mime = $fileinfo['mime'];
            $media->sort_order = $request->get('sort_order');
            $media->save();

            # data saved, return success status
            if ( $media )
              return 1;

          } # file uploaded

        } # action insert

      } # end has('save')

    } # request is ajax

    if ( $request->action == 'update' ) {
      $edit = ProductMediaModel::find( $request->id );
    }

    $view = [
      'edit' => $edit
    ];

    return view()->make('catalog.media.product', $view)->withErrors( $errors );
  }

  public function mediaList(Request $request)
  {
    if ( $request->ajax() )
    {

      $view = [
        'media' => ProductMediaRepo::getByProduct( $request->get('id') )
      ];

      return view()->make('catalog.media.list', $view);
    }
  }
}
