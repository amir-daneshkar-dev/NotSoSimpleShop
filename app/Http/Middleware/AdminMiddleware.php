<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || auth()->id() !== 1) {
            abort(404, 'Not Found');
        }

        return $next($request);
    }
}
