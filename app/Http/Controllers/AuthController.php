<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showHomepage()
    {
        if (auth()->check()) {
            $role_id = auth()->user()->role_id;
            if ($role_id == 1) {
                return redirect()->route('admin.home');
            } elseif ($role_id == 2) {
                return redirect()->route('user.home');
            }
        } else {
            return redirect('/login')->with(['error' => 'Tolong Login Terlebih Dahulu']);
        }
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Log::info('User ' . Auth::user()->name . ' logged in');

            // Redirect based on role
            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin.home');
            } elseif (Auth::user()->role_id == 2) {
                return redirect()->route('user.home');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

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
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        Log::info('User ' . $user->name . ' registered');

        // Redirect based on role
        if (Auth::user()->role_id == 1) {
            return redirect()->route('admin.home');
        } elseif (Auth::user()->role_id == 2) {
            return redirect()->route('user.home');
        }

        return redirect('/');
    }

    public function signOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
    public function logoutfast(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
