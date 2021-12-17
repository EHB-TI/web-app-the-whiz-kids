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
        if (is_null(Auth::user()->email_verified_at)) {
            if (Auth::user()->role == "admin" || Auth::user()->role == "super_admin") {
                return redirect()->route('admin.change-password')
                    ->with('status', 'This is your first login, please enter a new password with min 16 characters, including at least one: number, symbol, upper and lowercase characters.');
            } else {
                return redirect()->route('admin.change-password')
                    ->with('status', 'This is your first login, please enter a new password with min 8 characters, including at least one: number, symbol, upper and lowercase characters.');
            }
        }

        return $next($request);
    }
}
