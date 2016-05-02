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
use Library\Models\Taxonomy;
use Library\Models\Product;

class Test extends BaseController
{
	public function index()
	{
    $product = Product::find(1);

    $group = Taxonomy::select('*')->whereIn( 'id', function($query) use ($product) {
      $query->selectRaw('parent FROM product_term WHERE id IN( SELECT term_id FROM product_term_relation WHERE product_id = ? ) GROUP BY parent', [$product->id]);
    });

    dump($group->get());
	}
}