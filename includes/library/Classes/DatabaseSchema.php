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
  public function administrators()
  {
    Schema::dropIfExists('administrators');
    Schema::create('administrators', function(Blueprint $table) {

      $table->unsignedTinyInteger('id', true);
      $table->string('username', 25)->unique();
      $table->string('password', 60);
      $table->string('usermail', 50)->unique();
      $table->rememberToken();
      $table->timestamps();

    });

    $administrator = new Administrator;
    $administrator->username = 'admin';
    $administrator->password = bcrypt('admin');
    $administrator->usermail = 'hoiyen.2000@gmail.com';
    $administrator->save();
  }

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
      $table->string('name', 100);
      $table->text('description')->nullable();
      $table->decimal('price', 10, 2);
      $table->string('status', 10)->default('draft');
      $table->timestamps();

    });

    # products category
    Schema::dropIfExists('product_category');
    Schema::create('product_category', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedMediumInteger('parent_id')->default(0);
      $table->string('name', 100);
      $table->timestamps();

    });

    # connection between products and categories
    Schema::dropIfExists('product_to_category');
    Schema::create('product_to_category', function(Blueprint $table) {

      $table->unsignedMediumInteger('product_id');
      $table->unsignedMediumInteger('product_category_id');

    });

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

  }

  # upgrade
  # DATABASE VERSION 0.0.2
  private function upgrade_002()
  {
    # add product meta
    Schema::dropIfExists('product_media');
    Schema::create('product_media', function(Blueprint $table) {

      $table->increments('id');
      $table->unsignedMediumInteger('product_id');
      $table->string('name', 50)->nullable();
      $table->text('meta')->nullable();

    });

  }

  # upgrade
  private function upgrade_003()
  {
    # add product meta
    Schema::dropIfExists('product_term');
    Schema::create('product_term', function(Blueprint $table) {

      $table->increments('id');
      $table->unsignedMediumInteger('parent')->default(0);
      $table->string('name', 100);
      $table->string('slug', 100);
      $table->string('type', 50);
      $table->tinyInteger('sort')->default(0);
      $table->timestamps();
      $table->softDeletes();

    });

  }  

  public function install()
  {
    $this->administrators();
    $this->settings();
    $this->products();
  }

  public function upgrade()
  {
  }
}