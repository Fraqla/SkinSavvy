<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminConsultantStatus
{
    public function handle(Request $request, Closure $next)
    {
        // Skip middleware for Livewire requests and waiting-approval route
        if ($request->is('livewire/*') || $request->routeIs('waiting-approval')) {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->status === 'pending') {
            return redirect()->route('waiting-approval')
                ->with('message', 'Your account is awaiting approval.');
        }

        return $next($request);
    }
}