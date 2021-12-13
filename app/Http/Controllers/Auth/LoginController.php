<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Models\Lockout;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
    public $logger; 
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
        $this->logger = \Log::channel('logging_table');
    }

    protected $maxAttempts = 5;
    protected $decayMinutes = 2;

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function login(Request $request) {
        $key = $this->throttleKey($request);

        $lockout = Lockout::where('throttleKey', $key)->first();

        if ($lockout != null && $lockout->end > Carbon::now()) {
            $diff = strtotime($lockout->end) - Carbon::now()->getTimestamp();

            if($diff > 60) {
                $error = "You cannot login for " . ceil($diff / 60) . " minutes";
            } else {
                $error = "You cannot login for " . $diff . " seconds";
            }

            return back()->withErrors([
                "email" => $error
            ]);
        }

        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"]
        ]);

        if (Auth::attempt($credentials)) {
            $this->clearLoginAttempts($request);
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

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

        if ($this->hasTooManyLoginAttempts($request)) {
            if($lockout == null) {
                $lockout = new Lockout();
                $lockout->throttleKey = $key;
                $lockout->duration = 3;
            } else {
                $lockout->duration = $lockout->duration * 3;
            }
            $lockout->end = Carbon::now()->addMinutes($lockout->duration);
            $lockout->save();

            return back()->withErrors([
                "email" => "You cannot login for " . $lockout->duration . " minutes"
            ]);
        }

            $key = $this->throttleKey($request);
            
            $this->logger->info('Login attempt failed at throttleKey: '.$key);

        return back()->withErrors([
            "email" => "The provided credentials do not match our records."
        ]);
            
        }
    }
}
