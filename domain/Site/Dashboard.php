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

class Dashboard extends BaseController
{
  public function homepage()
  {
    $view = [
      'products' => ProductRepo::getData()
    ];

    return view('homepage', $view);
  }
}