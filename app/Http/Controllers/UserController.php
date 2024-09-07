<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'organization' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'consent_data_storage' => 'required|accepted',
            'consent_notifications' => 'required|accepted',
            'consent_reviewing' => 'required|accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'organization' => $request->organization,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'consent_data_storage' => $request->has('consent_data_storage'),
            'consent_notifications' => $request->has('consent_notifications'),
            'consent_reviewing' => $request->has('consent_reviewing'),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        // Add logic to update user profile
    }
}