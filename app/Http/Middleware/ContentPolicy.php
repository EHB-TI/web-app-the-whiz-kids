<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentPolicy
{

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->header('Content-Security-Policy', "default-src 'self'; img-src 'self' *; script-src 'self' 'unsafe-eval' 'unsafe-inline' *.jquery.com *.jsdelivr.net unpkg.com; style-src 'unsafe-inline' 'self' *.jsdelivr.net *.googleapis.com; font-src *.gstatic.com");

        return $response;
    }

}