<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 1. Create the User account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient', // Explicitly set role
        ]);

        // 2. Create the Patient Profile (Industry Practice: Link User to Patient Data)
        Patient::create([
            'first_name' => explode(' ', $request->name)[0],
            'last_name' => explode(' ', $request->name)[1] ?? '',
            'email' => $request->email,
            'patient_number' => 'P-' . strtoupper(uniqid()),
            'status' => 'Active',
        ]);

        Auth::login($user);

        return redirect()->route('portal.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('portal.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
