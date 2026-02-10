<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-Token');
        if (!$token) {
            return response()->json([
                'success' => false,
                'data' => 'Token header missing'
            ], 401);
        }

        // 👉 простой вариант (env)
        if ($token !== "8f6d9b2a4c7e1a9d3f0e5c8b7a4d6e9f2c1b0a8e7d6f5c4b3a2e1d9c8f7a6b") {
            return response()->json([
                'success' => false,
                'data' => 'Invalid API token'
            ], 403);
        }

        return $next($request);
    
        
        
    }
}
