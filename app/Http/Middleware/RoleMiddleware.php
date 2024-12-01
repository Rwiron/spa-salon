<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === $role) {
            return $next($request);
        }

        // Redirect if the user does not have the required role
        return redirect('/login')->withErrors(['You do not have access to this section.']);
    }
}