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
namespace App\Http\Manager\Config;

use Settings;
use Illuminate\Http\Request;
use App\Http\Manager\AbstractController;

class Configuration extends AbstractController
{
  public function index( $type = 'general' )
  {
    return view()->make('setting.index');
  }
}
