<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Log important information using the API log channel.
        Log::channel('api')->info('API Request', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'status_code' => $response->status(),
            'user_agent' => $request->header('User-Agent'),
            'total_time' => microtime(true) - LARAVEL_START
            // Add more important information as needed.
        ]);
    }
}
