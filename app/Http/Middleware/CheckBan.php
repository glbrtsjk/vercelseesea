<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBan
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_banned) {
            Auth::logout();

            return redirect()->route('login')
                ->with('error', 'Akun Kamu telah diblokir. Silakan hubungi admin untuk informasi lebih lanjut.');
        }

        return $next($request);
    }
}
