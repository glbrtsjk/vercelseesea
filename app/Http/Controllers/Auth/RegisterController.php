<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:500',
        ]);

       $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];


        if ($request->filled('bio')) {
            $userData['bio'] = $request->bio;
        }

        // Handle profile image upload if provided
        if ($request->hasFile('foto_profil')) {
            $image = $request->file('foto_profil');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            // Store image in public/profile_images directory
            $path = $image->storeAs('profile_images', $filename, 'public');
            $userData['foto_profil'] = $path;
        }

        $user = User::create($userData);
        Auth::login($user);

        return redirect()->route('user.dashboard')->with('success', 'Registration successful! Welcome to the dashboard.');
    }
}

