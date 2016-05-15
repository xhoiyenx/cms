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
 * Media service provider
 */
namespace Library\Providers;
use Illuminate\Support\ServiceProvider;
use Library\Classes\Theme;

class ThemeServiceProvider extends ServiceProvider
{
  protected $defer = true;

  public function register()
  {
    $this->app->singleton('theme', function ($app){
      return new Theme($app);
    });
  }

  public function provides()
  {
    return ['theme'];
  }
}
