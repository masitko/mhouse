<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  public function handle($request, Closure $next, $guard = null)
  {
    if (Auth::guard($guard)->check()) {
      if ($request->route()->getName() !== 'auth.code')
        return redirect('/');
    }

    return $next($request);
  }
}
