<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * 1. Show the profile edit page (This fixes your crash!)
     */
    public function edit()
    {
        // Grab the currently logged-in user
        $user = Auth::user();

        // Load the HTML view and pass the user data to it
        // Note: Ensure you have a file at resources/views/profile/edit.blade.php
        return view('profile.edit', compact('user'));
    }

    /**
     * 2. Update the user's profile information.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Use 'password' to match the validation 'confirmed' rule
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update password if the user typed a new one
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
