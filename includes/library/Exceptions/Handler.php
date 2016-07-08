<?php

namespace Library\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that should not be reported.
   *
   * @var array
   */
  protected $dontReport = [
    AuthorizationException::class,
    HttpException::class,
    ModelNotFoundException::class,
    ValidationException::class,
  ];

  /**
   * Report or log an exception.
   *
   * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
   *
   * @param  \Exception  $e
   * @return void
   */
  public function report(Exception $e)
  {
    parent::report($e);
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Exception  $e
   * @return \Illuminate\Http\Response
   */
  public function render($request, Exception $e)
  {
    # handle url not found
    if ( $e instanceof HttpException ) {

      # administrators
      if ( $request->is('manager/*') ) {
        # define default view path for manager
        view()->addLocation( public_path('manager/view') );
        return response()->view('inc.404');
      }
      # front
      else {

      }

    }

    return parent::render($request, $e);
  }
}