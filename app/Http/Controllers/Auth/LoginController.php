<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

    /**
     * Override the login method to handle role-based login
     */
    public function login(Request $request)
    {
        $request->validate([
            'login_type' => 'required|in:admin,patient',
        ]);

        $loginType = $request->login_type;

        // If patient login type is selected, handle patient login
        if ($loginType === 'patient') {
            $request->validate([
                'nik' => 'required|string|size:16',
                'password' => 'required',
            ]);

            // Find user by NIK
            $user = \App\Models\User::where('nik', $request->nik)->first();

            if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                // Check if user is actually a patient
                if ($user->role && $user->role->name === 'patient') {
                    Auth::login($user);
                    $request->session()->regenerate();
                    return redirect()->route('patient.dashboard')->withCookie(cookie('user_type', 'patient', 60*24*30)); // 30 days
                } else {
                    return back()->withErrors([
                        'nik' => 'NIK ini tidak terdaftar sebagai akun pasien.',
                    ])->withInput($request->only('nik', 'login_type'));
                }
            }

            return back()->withErrors([
                'nik' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
            ])->withInput($request->only('nik', 'login_type'));
        }

        // For admin login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if user is a patient - if so, logout and show error
            if ($user->role && $user->role->name === 'patient') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun ini adalah akun pasien. Silakan pilih "Login sebagai Pasien" dan gunakan NIK.',
                ])->withInput($request->only('email', 'login_type'));
            }

            // Successful admin login - set cookie to remember user type
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME)->withCookie(cookie('user_type', 'admin', 60*24*30)); // 30 days
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->withInput($request->only('email', 'login_type'));
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = Auth::user();
        $role = $user->role->name ?? 'guest';

        // Redirect patient to their dashboard
        if ($role === 'patient') {
            return route('patient.dashboard');
        }

        // Default redirect for other roles
        return RouteServiceProvider::HOME;
    }

    /**
     * Override the redirect path to handle role-based redirects
     */
    protected function redirectPath()
    {
        $user = Auth::user();
        $role = $user->role->name ?? 'guest';

        // Redirect patient to their dashboard
        if ($role === 'patient') {
            return route('patient.dashboard');
        }

        // Default redirect for other roles
        return RouteServiceProvider::HOME;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
