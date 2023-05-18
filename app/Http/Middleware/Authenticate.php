<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // if route is /api/* return 401
        if ($request->is('api/*')) {
            return response()->json(['message' => 'Unauthenticated.'], \Illuminate\Http\Response::HTTP_UNAUTHORIZED);
        }

        return Route::has('login') ? route('login') : null;
    }
}
