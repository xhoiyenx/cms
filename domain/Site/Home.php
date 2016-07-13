<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 24/03/2016
 *
 * Domain: 
 * Public
 * 
 * Description:
 * Default Controller
 */
namespace Domain\Site;

use Library\Repository\ProductRepo;

class Home extends Base
{
  public function homepage()
  {
    $view = [
    ];

    return view('home', $view);
  }
}