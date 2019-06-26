<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;


class SchoolAccess
{
  /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  public function handle($request, Closure $next)
  {
    // this will add school selection for options

    // $skip = ['checklists']; // skip paths containing
    // $addSchool = true;
    // foreach($skip as $segment) {
    //   if( strpos( $request->pashInfo, $segment) === false ) 
    //     $addSchool = false;
    // }

    if ($request->user() ) {
      $request->request->add([
        'pivotParams' => json_encode([
          'school' => [
            'id' => $request->user()->school_id
          ]
        ])
      ]);
    }
    return $next($request);
  }
}
