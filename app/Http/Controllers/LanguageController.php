<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    /**
     * Change the application language.
     */
    public function change(Request $request)
    {
        $validatedData = $request->validate([
            'language' => 'required|string|in:en,id',
        ]);

        $language = $validatedData['language'];

        // Store the language in session
        Session::put('locale', $language);

        // Update user's preferred language if logged in
        if (Auth::check()) {
            $user = Auth::user();
            $user->preferred_language = $language;
            $user->save();
        }

        // Set the application locale
        App::setLocale($language);

        return redirect()->back();
    }
}
