<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->user()) {
            return response()->json(['error' => 'Unauthorized - No User'], 403);
        }

        if (!auth()->user()->hashRole($role)) {
            return response()->json(['error' => 'Forbidden - No Role: ' . $role], 403);
        }
        return $next($request);
    }
}
