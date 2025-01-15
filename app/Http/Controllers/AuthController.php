<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserRegisteredMail;

class AuthController extends Controller
{
    // Show signup form
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Process signup
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|digits_between:10,15',
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'number' => $request->number,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Send confirmation email
        Mail::to($user->email)->send(new UserRegisteredMail($user));

        return redirect()->route('login')->with('success', 'Account created successfully! A confirmation email has been sent.');
    }

    // Show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Process login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Store user in session
            Auth::login($user);

            return redirect()->route('user.main')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
