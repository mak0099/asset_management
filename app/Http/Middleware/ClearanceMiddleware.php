<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class ClearanceMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) { //If user has this //permission
            return $next($request);
        }
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            if ($request->is($permission->url)) {//If user is creating a post
                if (!Auth::user()->hasPermissionTo($permission->name)) {
                    abort('401');
                } else {
                    return $next($request);
                }
            }
        }
        

        return $next($request);
    }

}
