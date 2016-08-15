<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 28/02/2016
 *
 * Domain: 
 * Manager
 * 
 * Type: 
 * Controller
 * 
 * Description:
 * Dashboard page
 */

namespace Domain\Manager\Auth;

use Auth;
use Illuminate\Http\Request;
use Domain\Manager\BaseController;
use Library\Model\Manager;

class Authentication extends BaseController
{
  public function init(Request $request = null)
  {
  }

  public function login( Request $request )
  {
    # submit login
    if ( $request->isMethod('post') ) {
      $login = [
        'username' => $request->input('username'),
        'password' => $request->input('password')
      ];

      if ( Auth::attempt( $login ) ) {
        return redirect()->intended( route('manager.dashboard') );
      }
      else {
        return back()->withErrors('Login Failed');
      }
    }

    return view('auth.login');
  }

  public function logout()
  {
    Auth::logout();
    if ( ! Auth::check() )
      return redirect()->route('manager.login');
  }
}