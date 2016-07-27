<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 1.0.0
 * Last Update: 09/07/2016
 *
 * Domain: 
 * Library
 * 
 * Type: 
 * Exception Handler
 * 
 * Description:
 * Handle errors here
 */

namespace Library\Exceptions;

use View;
use Exception;
use Illuminate\Support\MessageBag;
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
    if ($this->shouldReport($e)) {
      $this->log->error($e->getMessage());
    }
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
        View::addLocation( public_path('manager/view') );
        return response()->view('inc.404');
      }
      # front
      else {
        return (new \Domain\Site\Base(app()))->error();
      }
    }

    # handle mysql exception
    if ( $e instanceof \Illuminate\Database\QueryException ) {
      return redirect()->back()->withInput()->with('errors', new MessageBag([$e->getMessage()]));
    }

    return parent::render($request, $e);
  }
}