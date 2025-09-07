<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $authorizationHeader = $request->header('Authorization');

        if (!$authorizationHeader || !str_starts_with($authorizationHeader, 'Bearer ')) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        $token = substr($authorizationHeader, 7);

        $validToken = env('API_TOKEN');

        if ($token !== $validToken) {
            return response()->json(['message' => 'Invalid token'], 403);
        }

        return $next($request);
    }
}
