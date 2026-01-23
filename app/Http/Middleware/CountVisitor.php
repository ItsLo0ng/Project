<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CountVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->path() === '/') {
            Cache::increment('visitor_count');
        }

        return $next($request);
    }
}