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
namespace App;

use Illuminate\Database\Schema\Blueprint;
use App\Models\Administrator;
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
    Schema::dropIfExists('product');
    Schema::create('product', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->string('name', 100);
      $table->text('description')->nullable();
      $table->decimal('price', 10, 2);
      $table->text('image')->nullable();
      $table->timestamps();

    });

    Schema::dropIfExists('product_category');
    Schema::create('product_category', function(Blueprint $table) {

      $table->mediumIncrements('id');
      $table->unsignedMediumInteger('parent_id')->default(0);
      $table->string('name', 100);
      $table->timestamps();

    });

    Schema::dropIfExists('product_to_category');
    Schema::create('product_to_category', function(Blueprint $table) {

      $table->unsignedMediumInteger('product_id');
      $table->unsignedMediumInteger('product_category_id');

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
    $this->products();
  }
}