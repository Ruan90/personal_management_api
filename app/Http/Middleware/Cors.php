<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class Cors extends Middleware
{

  public function handle(Request $request, Closure $next)
  {
      return $next($request)->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE,
   OPTIONS')
          ->header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-
   Type, Accept, Authorization');
  }
}
