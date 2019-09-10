<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if ($request->user()->hasRole('superAdmin')) {
            return $next($request);

        }elseif($request->user()->hasRole($role)){
            return $next($request);
        }

        abort('403', 'Vous n\'avez pas accès a cette partie du site');
    }
}
