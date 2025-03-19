<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // ✅ Ensure user is authenticated and has the correct role
        if (auth()->check() && auth()->user()->hasRole($role)) {
            return $next($request);
        }

        // 🚨 If not authorized, abort with 403 Forbidden
        abort(403, 'Unauthorized action.');
    }
}
