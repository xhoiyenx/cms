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

class Test extends BaseController
{
	public function index()
	{
    $product = Product::find(1);

    $groups = $product->attributeGroups();
    foreach ( $groups as $group ) {
    	dump( $group->name . ': ' . $group->children->lists('name', 'id') );
    }
	}
}