<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected $maxAttempts = 5;
    protected $decayMinutes = 2;

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"]
        ]);

        if (Auth::attempt($credentials)) {
            $this->clearLoginAttempts($request);
            $request->session()->regenerate();

            $user = Auth::user();
            if (isset($request["remember"])) {
                if ($user->role == "admin" || $user->role == "super_admin") {
                    return redirect()->route('admin.index')
                        ->with('error', 'Omwille van veiligheidsredenen, is de remember-me functie uitgeschakeld voor admins!');
                } else {
                    if (Auth::attempt($credentials, true)) {
                        return redirect()->route('admin.index');
                    }
                }
            }
            return redirect()->route('admin.index');
        }else {
            $this->incrementLoginAttempts($request);

            $key = $this->throttleKey($request);
            //$this->logger->info('Login attempt failed at throttleKey: '.$key);

            return back()->withErrors([
                "email" => "The provided credentials do not match our records."
            ]);
        }
    }
}
