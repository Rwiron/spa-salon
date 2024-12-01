<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Auth::user()->load('role');  // Ensure role is loaded with the user

            // Redirect based on user role
            if ($user->role->name === 'Super Admin') {
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->role->name === 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role->name === 'Manager') {
                return redirect()->route('manager.dashboard');
            } elseif ($user->role->name === 'Staff') {
                return redirect()->route('staff.dashboard');
            } else {
                return redirect()->route('customer.dashboard');
            }
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}