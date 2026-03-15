<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403, 'Unauthorized action.');
        }

        if (empty($roles)) {
            return $next($request);
        }

        $normalizedRoles = array_map(static fn (string $role): string => strtoupper($role), $roles);

        if (! in_array($user->systemRole?->name, $normalizedRoles, true)) {
            abort(403, 'You are not allowed to access this resource.');
        }

        return $next($request);
    }
}