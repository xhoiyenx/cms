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

  public function index( Request $request )
  {
    var_dump($request->all());
  }

}