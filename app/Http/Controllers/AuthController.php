<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Check if the request is an API call
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);
        }
        // Redirect to the login page with a success message for web requests
        return redirect()->route('login')->with('message', 'Inscription réussie, veuillez vous connecter.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = auth()->user();
        $token = $user->createToken('token-name')->plainTextToken;
        /*
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'token' => $token
            ], 200);
        }
        */
        return redirect()->route('dashboard')->with('message', 'Connexion réussie.');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'You have been logged out.');
    }

}