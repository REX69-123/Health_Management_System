<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * 1. Show Login Form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * 2. Show Register Form (CRITICAL: This was likely missing)
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * 3. Handle Login
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            $role = strtolower($user->role);

            // STRICT WALL: Are they Admin or Staff?
            if (!in_array($role, ['admin', 'staff'])) {
                Auth::logout(); // Kick the patient out of the admin panel
                return back()->withErrors([
                    'email' => 'Patients cannot access the Admin panel. Please use the Patient Portal.',
                ]);
            }

            // They passed the test. Generate session and send to the 'patient' folder
            $request->session()->regenerate();

            // This route should load a view like: return view('patient.index');
            return redirect()->route('patients.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * 4. Handle Registration
     */
    public function register(Request $request)
    {
        // 1. Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Create User in MySQL
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Redirect to Login with a success "flash" message
        return redirect()->route('login')->with('success', 'Account created! Please log in.');
    }

    /**
     * 5. Handle Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
