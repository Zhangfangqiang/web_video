<?php

namespace App\Http\Middleware;

use Closure;

class AdminUserPermission
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
        return $next($request);

        #if (\Auth::user()->can(\Route::currentRouteName())) {
        #    return $next($request);
        #}

        #return \Redirect::back();
    }
}
