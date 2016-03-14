<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 06/03/2016
 *
 * Domain: 
 * Manager
 * 
 * Type: 
 * Controller
 * 
 * Description:
 * Configuration page
 */
namespace Domain\Manager\Config;

use Settings;
use Illuminate\Http\Request;
use Domain\Manager\BaseController;

class Configuration extends BaseController
{
  public function index( $type = 'general' )
  {
    return view()->make('setting.index');
  }
}
