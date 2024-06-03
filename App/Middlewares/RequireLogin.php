<?php

namespace App\Middlewares;

use App\Http\Request;
use App\Config\Session;

class RequireLogin
{
  public function handle(Request $request, callable $next)
  {
    $key = isset($_SESSION['admin']) ? 'admin' : (isset($_SESSION['user']) ? 'user' : '');

    if (!Session::isLogged($key)) {
      $request->getRouter()->redirect('/admin/login');
    }

    return $next($request);
  }
}