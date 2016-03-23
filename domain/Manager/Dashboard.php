<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 28/02/2016
 *
 * Domain: 
 * Manager
 * 
 * Description:
 * Dashboard page
 */

namespace Domain\Manager;

class Dashboard extends BaseController
{
  public function index()
  {
  	$this->setPage('Dashboard');
    return view('dashboard');
  }
}
