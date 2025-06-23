<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Refresh the CSRF token when showing the login form
        Session::regenerateToken();
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Make remember explicit and clearly handled
        $remember = $request->boolean('ingatkan');

        if (Auth::attempt($credentials, $remember)) {
            // pembaruan sesi untuk mencegah serangan CSRF
            $request->session()->regenerate();
         $user = Auth::user();
        $user->updateLastActive();
            //menyimpan coookie untuk mengingat email pengguna
            if ($remember) {
                Cookie::queue(
                    'remember_user_email',
                    $request->email,
                    43200 // 30 hari dalam menit (as integer)
                );
            }

            // Check user role and redirect accordingly
            if (Auth::user()->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Regular users go to user dashboard
            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear remember cookie if it exists
        if ($request->hasCookie('remember_user_email')) {
            Cookie::queue(Cookie::forget('remember_user_email'));
        }

        return redirect('/');
    }
}
