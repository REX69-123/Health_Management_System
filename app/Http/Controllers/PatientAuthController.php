<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{
    /**
     * Show the patient login form
     */
    public function showLogin()
    {
        // Point this to a new dedicated patient login view
        return view('auth.patient-login');
    }

    /**
     * Handle Patient Login (No Registration Allowed)
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in using the 'patient' guard specifically
        if (Auth::guard('patient')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/portal/dashboard');
        }

        // If it fails, it might be trying to check the Admin table
        return back()->withErrors([
            'email' => 'The provided credentials do not match our patient records.',
        ]);
    }

    public function logout(Request $request)
    {
        // 1. Specifically logout from the patient guard
        Auth::guard('patient')->logout();

        // 2. Invalidate the session to clear patient data
        $request->session()->invalidate();

        // 3. Regenerate the CSRF token for security
        $request->session()->regenerateToken();

        // 4. Redirect to the PATIENT login, not the admin one
        return redirect()->route('portal.login')->with('success', 'Logged out successfully.');
    }
}
