<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdminConsultantIsActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (!$user->hasRole('admin_consultant') || $user->status !== 'active') {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}