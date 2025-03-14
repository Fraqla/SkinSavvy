<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SystemAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 'system_admin') {
            return redirect()->route('dashboard')->with('error', 'Access Denied!');
        }

        return $next($request);
    }
}
