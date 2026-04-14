<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        $anyUserExists = User::exists();

        if ($anyUserExists) {
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Registration is closed. Please login as Admin to add staff.');
            }

            if (Auth::user()->role !== 'admin') {
                abort(403, 'Unauthorized. Only Administrators can access this page.');
            }
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $anyUserExists = User::exists();

        if ($anyUserExists) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $role = !$anyUserExists ? 'admin' : 'staff';

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $role,
        ]);

        if (!$anyUserExists) {
            Auth::login($user);
            return redirect()->route('patients.index')->with('success', 'Admin account created successfully!');
        }

        return redirect()->route('patients.index')->with('success', "New staff member ({$user->name}) added successfully!");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            $role = strtolower($user->role ?? '');

            if (!in_array($role, ['admin', 'staff'])) {
                Auth::logout();
                return back()->withErrors(['email' => 'Access denied. Use the Patient Portal for patient logins.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('patients.index'));
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
