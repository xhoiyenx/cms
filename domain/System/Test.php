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

use Library\Classes\DatabaseSchema;
use Library\Repository\ProductTaxonomy;

class Test extends BaseController
{
	public function index()
	{
		$tree = ProductTaxonomy::selectTree('category');

    echo '<pre style="font: 12px courier new">';
    var_dump($tree);

	}
}