<?php
namespace Library\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  $guard
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null)
  {
    if (auth()->getDefaultDriver() == 'manager')
    {
      if (auth()->guest()) {
        if ($request->ajax() || $request->wantsJson()) {
          return response('Unauthorized.', 401);
        } else {
          return redirect()->route('manager.login');
        }
      }
    }

    return $next($request);
  }
}