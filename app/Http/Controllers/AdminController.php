<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::latest()->get(); // Add ->where('role', 'admin') if needed
        $totalAdmins = $admins->count(); // Calculate total for the stat card

        return view('admins.index', compact('admins', 'totalAdmins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // <-- MAKE SURE THIS LINE IS UNCOMMENTED/ADDED
        ]);

        return redirect()->route('admins.index')->with('success', 'New Administrator added successfully!');
    }

    public function create()
    {
        return view('admins.create');
    }

    // Show the edit form
    public function edit(User $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    // Save the updated details
    // Save the updated details
    public function update(Request $request, User $admin)
    {
        // 1. Base validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
        ];

        // 2. If they typed a password, add password validation rules
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules);

        // 3. Prepare the data to update
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // 4. Hash and add the password ONLY if they typed a new one
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admins.index')->with('success', 'Administrator updated successfully!');
    }

    // Delete the admin
    public function destroy(User $admin)
    {
        // Prevent the logged-in admin from deleting themselves
        if (Auth::id() === $admin->id) {
            return redirect()->route('admins.index')->with('error', 'You cannot delete your own account.');
        }

        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Administrator removed.');
    }
}
