<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Used as 'role:admin' (or 'role:admin,editor'). The roles after the colon
     * arrive here as the variadic $roles array.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Authentication — is anyone logged in?
        if (! Auth::check()) {
            return redirect()->guest(route('login'));
        }

        // 2. Authorization — does the logged-in user have one of the required roles?
        if (! Auth::user()->hasAnyRole($roles)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
