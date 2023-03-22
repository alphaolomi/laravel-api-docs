<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;

class Active
{
    public function handle(Request $request, Closure $next)
    {
        if (!request()->has('active')) {
            return $next($request);
        }

        return $next($request)->where('active', request()->input('active'));
    }
}
