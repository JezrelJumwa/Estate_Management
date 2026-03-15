<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json(['message' => 'Missing API token.'], 401);
        }

        $user = User::query()->where('api_token', hash('sha256', $token))->first();

        if (! $user) {
            return response()->json(['message' => 'Invalid API token.'], 401);
        }

        auth()->setUser($user);

        return $next($request);
    }
}
