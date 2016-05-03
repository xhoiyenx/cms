<?php
namespace Library\Http;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
  protected $middleware = [];
  protected $middlewareGroups = [
    'manager' => [
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    ],
    'system' => [
      \Illuminate\Session\Middleware\StartSession::class,
      \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
      \Illuminate\View\Middleware\ShareErrorsFromSession::class,
      #\Library\Http\Middleware\VerifyCsrfToken::class
    ],    
  ];
  protected $routeMiddleware = [
    'auth'        => \Library\Http\Middleware\Authenticate::class,
    'auth.basic'  => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
  ];
}