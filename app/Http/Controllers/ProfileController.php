<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function edit()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Return the edit profile view with the user data
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'gender' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Increased size limit

        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update user details
        $user->name = $request->name;
        $user->number = $request->number;
        $user->gender = $request->gender;

        // Handle the profile picture upload
        if ($request->hasFile('image')) {
            // Store the new image and update the user record
            $path = $request->file('image')->store('profile_pictures', 'public');
            $user->image = $path;
        }

        // Save the updated user data
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
