<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminConsultantStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status === 'pending') {
            // Redirect to the waiting-approval page with a message
            return redirect()->route('waiting-approval')->with('message', 'Your account is awaiting approval.');
        }

        return $next($request);
    }
}
