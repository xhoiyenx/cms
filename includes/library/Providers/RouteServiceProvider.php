<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 1.0.0
 * Last Update: 15/03/2016
 *
 * Domain: 
 * Library
 * 
 * Description:
 * Routes service provider, all routes assigned from here
 */
namespace Library\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Library\Model\Page;

class RouteServiceProvider extends ServiceProvider
{

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @param  \Illuminate\Routing\Router  $router
   * @return void
   */
  public function boot(Router $router)
  {
    $router->pattern('id', '[0-9]+');

    # return 404 if page model not found
    $router->model('page', Page::class, function () {
      throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
    });

    parent::boot($router);
  }

  public function map(Router $router)
  {
    /**
     * Manager route group specifications
     * @var array
     */
    $manager = [
      'namespace'   => 'Domain\Manager',
      'prefix'      => 'manager',
      'middleware'  => 'manager',
      'as'          => 'manager.'
    ];

    /**
     * Assign manager router group
     */
    $router->group( $manager, function($router){
      require $this->app['path.domain'] . '/routes-admin.php';
    });

    /**
     * System route group specifications
     * @var array
     */
    $system = [
      'namespace'   => 'Domain\System',
      'prefix'      => 'system',
      'middleware'  => 'system',      
      'as'          => 'system.'
    ];

    /**
     * Assign system router group
     */
    $router->group( $system, function($router){
      require $this->app['path.domain'] . '/routes-system.php';
    });

    /**
     * Public route group specifications
     * @var array
     */
    $public = [
      'namespace'   => 'Domain\Site',
      'as'          => ''
    ];

    /**
     * Assign public router group
     */    
    $router->group( $public, function($router){
      require $this->app['path.domain'] . '/routes-public.php';
    });
    
  }
}
