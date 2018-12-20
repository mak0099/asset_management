<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SubUnitMiddleware
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
        if(Auth::user()->unit_type() != "Sub Unit"){
            abort('401');
        }
        return $next($request);
    }
}
