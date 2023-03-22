<?php

namespace App\Filters;

use Closure;
use Illuminate\Http\Request;

class Sort
{
    public function handle(Request $request, Closure $next)
    {
        if (! request()->has('sort')) {
            return $next($request);
        }

        return $next($request)->orderBy('title', $request->input('sort'));
    }
}
