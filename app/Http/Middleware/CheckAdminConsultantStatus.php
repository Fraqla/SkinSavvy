<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminConsultantStatus
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'admin_consultant' && auth()->user()->status !== 'active') {
            return redirect()->route('waiting-approval')->with('message', 'Your account is awaiting approval.');
        }

        return $next($request);
    }
}
