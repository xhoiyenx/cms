<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 06/03/2016
 *
 * Domain: 
 * Global
 * 
 * Type: 
 * Schema
 * 
 * Description:
 * Schema and generator for database tables
 */
namespace Library\Classes;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use Hash;

class DatabaseSchema
{

  public function settings()
  {
    Schema::dropIfExists('settings');
    Schema::create('settings', function(Blueprint $table) {

      $table->smallIncrements('id');
      $table->string('name', 50)->unique();
      $table->text('value');
      $table->char('autoload', 1)->default('0');
      $table->timestamps();

    });
  }

  public function products()
  {
    # products
    Schema::dropIfExists('product');
    Schema::create('product', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedMediumInteger('parent')->default(0);
      $table->string('sku', 100)->unique()->nullable();
      $table->string('name', 200);
      $table->text('description')->nullable();
      $table->decimal('price', 10, 2)->default('0.00');
      $table->enum('use_stock', ['n', 'y'])->default('n');
      $table->unsignedSmallInteger('qty_stock')->default(0);
      $table->string('status', 10)->default('draft');
      $table->timestamps();

    });

    # products
    Schema::dropIfExists('product_detail');
    Schema::dropIfExists('product_category');
    Schema::dropIfExists('product_to_category');
    Schema::dropIfExists('product_taxonomy');
    Schema::dropIfExists('product_attribute');

    # product media
    Schema::dropIfExists('product_media');
    Schema::create('product_media', function(Blueprint $table) {

      $table->increments('id');
      $table->unsignedMediumInteger('product_id');
      $table->string('name', 200)->nullable();
      $table->text('link');
      $table->string('mime', 80);
      $table->unsignedTinyInteger('sort_order')->default(0);
      $table->timestamps();

    });

    # add product meta
    Schema::dropIfExists('product_term');
    Schema::create('product_term', function(Blueprint $table) {

      $table->smallIncrements('id');
      $table->unsignedSmallInteger('parent')->default(0);
      $table->string('name', 100);
      $table->string('slug', 100);
      $table->string('type', 50);
      $table->tinyInteger('sort')->default(0);
      $table->timestamps();
      $table->softDeletes();

    });

    # connection between products and taxonomy
    Schema::dropIfExists('product_term_relation');
    Schema::create('product_term_relation', function(Blueprint $table) {

      $table->unsignedMediumInteger('product_id');
      $table->unsignedSmallInteger('term_id');
      $table->string('type', 50);

    });
  }

  public function pages()
  {
    Schema::dropIfExists('pages');
    Schema::create('pages', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedMediumInteger('page_parent')->default(0);
      $table->string('page_type', 50)->default('page');
      $table->text('page_name');
      $table->text('page_slug');
      $table->text('page_desc')->nullable();
      $table->string('page_status', 20)->default('draft');
      $table->tinyInteger('sort')->default(0);
      $table->timestamps();

    });
  }

  public function menus()
  {
    Schema::dropIfExists('menus');
    Schema::create('menus', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedMediumInteger('menu_parent')->default(0);
      $table->string('menu_type', 50);
      $table->string('menu_name', 50);
      $table->text('menu_link');
      $table->boolean('new_tab')->default(0);
      $table->string('status', 20)->default('enabled');
      $table->tinyInteger('sort')->default(0);
      $table->timestamps();

    });

    Schema::dropIfExists('menus_meta');
    Schema::create('menus_meta', function(Blueprint $table) {

      $table->increments('id');
      $table->string('meta_key', 100);
      $table->text('meta_val');

    });
  }

  public function items()
  {
    Schema::dropIfExists('products');
    Schema::create('products', function(Blueprint $table) {

      $table->increments('id');
      $table->string('sku', 100)->unique();
      $table->text('name');
      $table->text('slug');
      $table->text('description')->nullable();
      $table->text('short_description')->nullable();
      $table->decimal('price', 10, 2)->default('0.00');      
      $table->string('status', 20)->default('active');
      $table->timestamps();
      $table->softDeletes();

    });
  }

  public function managers()
  {
    Schema::dropIfExists('managers');
    Schema::create('managers', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedSmallInteger('manager_role_id');      
      $table->string('usermail', 50)->nullable();
      $table->string('username', 50)->unique();
      $table->string('password', 60);
      $table->string('status', 25);
      $table->rememberToken();
      $table->timestamps();

    });    

    Schema::dropIfExists('manager_roles');
    Schema::create('manager_roles', function(Blueprint $table) {

      $table->unsignedSmallInteger('id', true);
      $table->string('manager_name', 100);      
      $table->boolean('is_admin')->default(0);
      $table->text('permissions')->nullable();
      $table->timestamps();      

    });
  }

  public function install()
  {
    $this->managers();
    $this->settings();
    $this->pages();
    $this->menus();    
  }

  public function upgrade()
  {
    $this->menus();
  }
}