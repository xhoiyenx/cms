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
use Library\Classes\Media as MediaClass;

class MediaServiceProvider extends ServiceProvider
{
  protected $defer = true;

  public function register()
  {
    $this->app->singleton('media', function ($app){
      $path = public_path('uploads');
      return new MediaClass($app, $path);
    });
  }

  public function provides()
  {
    return ['media'];
  }
}
