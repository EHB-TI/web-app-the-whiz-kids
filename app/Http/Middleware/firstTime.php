<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class FirstTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->created_at == Auth::user()->updated_at) {
            return redirect()->route('admin.change-password')
                ->with('status', 'This is your first login, please enter a new password');
        }

        return $next($request);
    }
}
