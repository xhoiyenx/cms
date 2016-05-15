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

class AppServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->register(MediaServiceProvider::class);
    $this->app->register(ThemeServiceProvider::class);
  }
}
