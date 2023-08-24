<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class APIVersion
{
    public function handle(Request $request, Closure $next, string $guard)
    {
        config(['app.api.version' => $guard]);
        return $next($request);
    }
}
