<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Session\TokenMismatchException;

class HandleCsrfException extends Middleware
{

    public function handle($request, Closure $next)
    {
        try {
            return parent::handle($request, $next);
        } catch (TokenMismatchException $e) {

            $request->session()->regenerateToken();

            if ($request->ajax()) {
                return response()->json(['error' => 'csrf token tidak sesuai.'], 419);
            }

            return redirect()->back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Sesi Anda telah kedaluwarsa. Silakan coba lagi.');
        }
    }
}
