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

        // Use the 'patient' guard so Laravel knows THIS is a patient session
        if (Auth::guard('patient')->attempt($credentials)) {
            $user = Auth::guard('patient')->user();

            // Extra security: check role
            if (strtolower($user->role) !== 'patient') {
                Auth::guard('patient')->logout();
                return back()->withErrors(['email' => 'This account is not a patient.']);
            }

            $request->session()->regenerate();

            // Use intended() to ensure they go to the dashboard
            return redirect()->intended(route('portal.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
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
