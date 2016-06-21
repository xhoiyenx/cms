<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 15/03/2016
 *
 * Domain: 
 * System
 * 
 * Description:
 * Handle application installation or upgrade
 */
namespace Domain\System;

use DB;
use Library\Classes\DatabaseSchema;
use Library\Repository\ProductTaxonomy;
use Library\Models\Taxonomy;
use Library\Models\Product;
use Library\Models\Page;

class Test extends BaseController
{
	public function index()
	{
    $id   = 4;
    $slug = 'hello-world';

    $check = 1;

    $i = 1;
    while ( $check = Page::where('slug', $slug)->where('id', '<>', $id)->count() ) {
      if ($i == 10) {
        break;
      }
      $slug = $slug . '-' . $i;
      $i++;
    }

	}
}