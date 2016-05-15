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
 * Theme handler library
 */
namespace Library\Classes;
use Illuminate\Contracts\Foundation\Application;

class Theme
{
  /**
   * Application
   * @var Illuminate\Contracts\Foundation\Application
   */
  public $app;

  /**
   * Url Generator
   * @var Illuminate\Contracts\Routing\UrlGenerator
   */
  public $url;

  public function __construct( Application $app )
  {
    $this->app = $app;
    $this->url = $app['url'];
  }

  public function theme_url()
  {
    dump($this->url);
  }
}