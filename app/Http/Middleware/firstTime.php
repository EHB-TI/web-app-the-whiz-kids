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
            if (Auth::user()->role == "admin" || $user->role == "super_admin") {
                return redirect()->route('admin.change-password')
                    ->with('status', 'This is your first login, please enter a new password with min 16 characters, number, symbol, upper and lowercase characters.');
            } else {
                return redirect()->route('admin.change-password')
                    ->with('status', 'This is your first login, please enter a new password with min 8 characters, number, symbol, upper and lowercase characters.');
            }
        }

        return $next($request);
    }
}
