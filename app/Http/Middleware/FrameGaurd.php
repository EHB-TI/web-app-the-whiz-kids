<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrameGaurd
{
    
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->header('X-Frame-Options', 'SAMEORIGIN', false);

        return $response;
    }
}