<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentPolicy
{

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->header('Content-Security-Policy', "default-src 'self'; img-src 'self' *; script-src 'self' 'unsafe-eval' 'nonce-c1079a6bccc2462cad6c4d94d1c07694' 'nonce-1652439ad94e496b9f74ffcb282d1658' 'nonce-bfb620f7816a4119a9961557ba8ce8fe' 'nonce-4631e09d23894382bac5f93234be3aec' 'nonce-2d30e9e8aa324eb0a04076c5abaff625' 'nonce-452de1949cc9487f96abaa61a336823b' 'nonce-ab7ccad4709e4606810311857087d8d5' 'nonce-f5f75162a3064c3e9f2d6adc32a9957a' 'nonce-9f7db5939a8648f1b7bd1b6ee1b6f5d3' 'nonce-a9698917a10641eaaaf19f29d477e722' 'nonce-028b2129f1304a25a8b81cb8787fb495' *.jquery.com *.jsdelivr.net unpkg.com; style-src 'unsafe-inline' 'self' *.jsdelivr.net *.googleapis.com; font-src *.gstatic.com");

        return $response;
    }

}