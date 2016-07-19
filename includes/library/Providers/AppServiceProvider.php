<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 15/03/2016
 *
 * Domain: 
 * Library
 *
 * Type:
 * Service Provider
 * 
 * Description:
 * Load all service providers here
 */
namespace Library\Providers;
use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
  public function boot()
  {
    $this->app->singleton('options', function ($app){
      $options = DB::table('settings')->where('autoload', 1)->lists('value', 'name');
      return $options;
    });
  }

  public function register()
  {
    $this->app->register(MediaServiceProvider::class);
    $this->app->register(ThemeServiceProvider::class);
  }
}
