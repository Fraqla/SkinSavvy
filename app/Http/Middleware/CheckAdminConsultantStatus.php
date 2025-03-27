<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminConsultantStatus
{
    public function handle(Request $request, Closure $next)
    {
        // Skip middleware for these routes - Fixed missing parenthesis
        if ($request->is('livewire/*')) {
            return $next($request);
        }
    
        $user = Auth::user();
    
        if (!$user) {
            return $next($request);
        }
    
        // If user is admin_consultant AND pending
        if ($user->hasRole('admin_consultant') && $user->status === 'pending') {
            // Only allow access to waiting-approval route
            if (!$request->routeIs('waiting-approval') && !$request->routeIs('logout')) {
                return redirect()->route('waiting-approval');
            }
        }
    
        return $next($request);
    }
}