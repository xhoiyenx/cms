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
use Library\Models\Administrator;
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

  public function users()
  {
    Schema::dropIfExists('user');
    Schema::create('user', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedSmallInteger('role_id');      
      $table->string('usermail', 50)->unique();
      $table->string('username', 25)->unique();
      $table->string('password', 60);
      $table->string('status', 25);
      $table->string('registration_key', 60);
      $table->rememberToken();
      $table->timestamps();

    });

    Schema::dropIfExists('user_detail');
    Schema::create('user_detail', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedMediumInteger('user_id');
      $table->string('type', 50);
      $table->string('fullname', 200);
      $table->string('company', 200)->nullable();
      $table->text('address')->nullable();
      $table->string('region', 200)->nullable();
      $table->string('city', 200)->nullable();
      $table->string('country', 200)->nullable();
      $table->string('postcode', 10)->nullable();
      $table->string('phone', 25)->nullable();
      $table->string('mobile', 25)->nullable();
      $table->string('fax', 25)->nullable();
      $table->tinyInteger('sort')->default(0);

    });

    Schema::dropIfExists('user_eav');
    Schema::create('user_eav', function(Blueprint $table) {

      $table->increments('id');
      $table->unsignedMediumInteger('user_id');
      $table->string('eav_key', 100);
      $table->text('eav_val');

    });

    Schema::dropIfExists('user_role');
    Schema::create('user_role', function(Blueprint $table) {

      $table->unsignedTinyInteger('id', true);
      $table->string('name', 100);      
      $table->boolean('is_admin')->default(0);
      $table->timestamps();      

    });

    Schema::dropIfExists('user_permission');
    Schema::create('user_permission', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedSmallInteger('role_id');
      $table->boolean('active')->default(1);
      $table->string('permission', 200);

    });    

  }

  public function pages()
  {
    Schema::dropIfExists('page');
    Schema::create('page', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedMediumInteger('parent')->default(0);
      $table->text('name');
      $table->text('slug');
      $table->text('description')->nullable();
      $table->string('status', 10)->default('draft');
      $table->timestamps();

    });
  }

  public function install()
  {
    #$this->administrators();
    $this->settings();
    $this->products();
    $this->users();
    $this->pages();
  }

  public function upgrade()
  {
  }
}