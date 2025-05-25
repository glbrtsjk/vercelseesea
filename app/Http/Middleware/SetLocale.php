<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetLocale
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
        // First priority: session locale
        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        // Second priority: user preferred language
        elseif (Auth::check() && Auth::user()->preferred_language) {
            $locale = Auth::user()->preferred_language;
            Session::put('locale', $locale);
        }
        // Default: from config
        else {
            $locale = config('languages.default_locale', 'en');
        }

        // Ensure the locale is valid
        if (!array_key_exists($locale, config('languages.locales'))) {
            $locale = config('languages.default_locale', 'en');
        }

        // Set application locale
        App::setLocale($locale);

        return $next($request);
    }
}

