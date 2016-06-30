<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 21/06/2016
 *
 * Domain: 
 * Manager
 * 
 * Description:
 * Media upload handler
 */

namespace Domain\Manager\Media;
use Domain\Manager\BaseController;

use File;
use Illuminate\Http\Request;

class Upload extends BaseController
{

  public function index( Request $request, $type )
  {
    # check if user upload an image
    if ( $request->hasFile('redactor-image') ) {
      $image = $request->file('redactor-image');
      if ( $image->isValid() ) {
        if ( $image->move( public_path('uploads/images'), $image->getClientOriginalName() )) {
          $info = [
            'filelink' => url('public/uploads/images/' . $image->getClientOriginalName())
          ];
          echo stripslashes(json_encode($info));
        }
      }
    }
  }

}