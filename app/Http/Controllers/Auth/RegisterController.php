<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Fetch the 'Customer' role by its name
        $customerRole = Role::where('name', 'Customer')->first();

      
        //dd($customerRole->id);  // Ensure it's 5

        // Create a new user and assign 'Customer' role by default
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $customerRole->id,  // Dynamically assign the role_id (should be 5)
        ]);

        return redirect()->route('auth.login')->with('success', 'Registration successful. Please log in.');
    }
}