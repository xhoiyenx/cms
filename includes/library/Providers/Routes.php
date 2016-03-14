<?php
namespace Library\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class Routes extends ServiceProvider
{
  public function map(Router $router)
  {
    $manager = [
      'namespace'   => 'Domain\Manager',
      'prefix'      => 'manager',
      'middleware'  => 'manager',
      'as'          => 'manager.'
    ];
    $router->group( $manager, function($router){
      require $this->app['path.domain'] . '/routes-admin.php';
    });

    require $this->app['path.domain'] . '/routes-public.php';
  }
}
