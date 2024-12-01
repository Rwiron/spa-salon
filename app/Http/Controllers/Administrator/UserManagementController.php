<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // Show all users with their roles
    public function index()
    {
        $users = User::with('role')->paginate(10); // Eager load roles
        return view('admin.users.index', compact('users'));
    }

    // Show form to create a new user
    public function create()
    {
        $roles = Role::all(); // Fetch all roles
        return view('admin.users.create', compact('roles'));
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id', // Validate role ID
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, // Assign role to the user
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show form to edit a user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all(); // Fetch all roles
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id, // Update the user's role
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}