<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientAuthController extends Controller
{
    /**
     * Show the Patient Login Form
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'patient') {
            return redirect()->route('portal.dashboard');
        }
        return view('portal.login');
    }

    /**
     * Show the Patient Registration Form
     */
    public function showRegister()
    {
        return view('portal.register');
    }

    /**
     * Handle the Login Logic
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // STRICT WALL: Are they actually a patient?
            if (strtolower($user->role) !== 'patient') {
                Auth::logout(); // Kick them out of the patient portal
                return back()->withErrors([
                    'email' => 'Staff/Admins cannot log in here. Please use the Admin Login page.',
                ]);
            }

            // They passed the test. Generate session and send to the 'portal' folder
            $request->session()->regenerate();

            // This route should load a view like: return view('portal.dashboard');
            return redirect()->route('portal.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle the Registration Logic
     */
    public function register(Request $request)
    {
        // 1. Validate the new fields
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'dob'      => 'required|date',
            'gender'   => 'required|string|in:Male,Female,Other',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Create User account (Authentication Data)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'patient',
        ]);

        // Split name for clinical records
        $nameParts = explode(' ', $request->name);

        // 3. Create Patient Record (Clinical Data)
        Patient::create([
            'first_name'     => $nameParts[0],
            'last_name'      => $nameParts[1] ?? 'Patient',
            'email'          => $request->email,
            'dob'            => $request->dob,
            'gender'         => $request->gender,
            'patient_number' => 'PAT-' . strtoupper(bin2hex(random_bytes(3))),
            'status'         => 'Active'
        ]);

        // 4. INDUSTRY FIX: Redirect to login instead of dashboard
        // We do NOT call Auth::login($user) here.
        return redirect()->route('portal.login')->with('success', 'Registration successful! Please log in to your new account.');
    }

    /**
     * Handle Portal Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('portal.login');
    }
}
