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

use Library\Repository\ProductRepo;

class Test extends BaseController
{
	public function index()
	{
    $product = ProductRepo::getProduct(1);
    dump($product->attributes->lists('id'));
	}
}