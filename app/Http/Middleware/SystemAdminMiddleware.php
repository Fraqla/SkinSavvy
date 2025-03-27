<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('signin')->with('error', 'Please log in to access this page.');
        }

        // ✅ Correct way to check the 'system_admin' role using Spatie's `hasRole()`
        if (!auth()->user()->hasRole('system_admin')) {
            // Redirect to dashboard with an error message
            return redirect()->route('dashboard')->with('error', 'Access Denied!');
        }

        // ✅ Allow the request to proceed if the user has the role
        return $next($request);
    }
}
