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
use Html;
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

  /**
   * Selected theme
   * @var string
   */
  public $theme;

  public function __construct( Application $app )
  {
    $this->app = $app;
    $this->url = $app['url'];
    $this->theme = 'shop';
  }

  /**
   * Get url path to selected theme folder
   * @return string
   */
  public function theme_url( $path = '' )
  {
    return $this->url->asset('public/themes/' . $this->theme . '/' . $path );
  }

  public function script( $path = '' )
  {
    return Html::script( $this->theme_url($path) );
  }

  public function style( $path = '' )
  {
    return Html::style( $this->theme_url($path) );
  }

  /**
   * Get absolute path to all themes folder
   * @return [type] [description]
   */
  public function themes_path()
  {
    return public_path('themes');
  }


}