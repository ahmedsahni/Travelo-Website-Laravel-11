<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Country;



class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Check if the logged-in user is an admin
        if (!auth()->check() || auth()->user()->role != 1) {
            abort(403, 'You do not have permission to access this page.');
        }

        $query = User::query();

        // If there’s a search term, filter users by name
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Fetch the users
        $users = $query->get();

        return view('admin.dashboard', compact('users'));
    }


    public function manageBooking()
    {
        if (!auth()->check() || auth()->user()->role != 1) {
            abort(403, 'You do not have permission to access this page.');
        }

        $bookings = Booking::with('user')->get();
        return view('admin.manage-booking', compact('bookings'));
    }

    public function editBooking($id)
    {
        if (!auth()->check() || auth()->user()->role != 1) {
            abort(403, 'You do not have permission to access this page.');
        }
        $booking = Booking::findOrFail($id); // Find the booking to be edited
        return view('admin.edit-booking', compact('booking')); // Pass the booking to the view
    }

    public function updateBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id); // Find the booking
        $booking->update($request->all()); // Update the booking with the new data
        return redirect()->route('admin.edit-booking')->with('success', 'Booking updated successfully');
    }

    public function editUser($id)
    {
        if (!auth()->check() || auth()->user()->role != 1) {
            abort(403, 'You do not have permission to access this page.');
        }

        $user = User::findOrFail($id); // Find the user by ID or throw a 404 error
        return view('admin.edit-user', compact('user')); // Pass the user data to the view
    }



    public function updateUser(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        $user->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
    }
    public function deleteUser(Request $request)
    {

        $userId = $request->input('delete_id');
        $user = User::find($userId);
        if ($user) {

            $user->delete();
            return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'User not found.');
    }


    public function countries()
    {
        if (!auth()->check() || auth()->user()->role != 1) {
            abort(403, 'You do not have permission to access this page.');
        }

        $countries = Country::all();
        return view('admin.countries', compact('countries'));
    }
    public function storeCountry(Request $request)
{
    if (!auth()->check() || auth()->user()->role != 1) {
        abort(403, 'You do not have permission to access this page.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Country::create([
        'name' => $request->input('name'),
    ]);

    return redirect()->route('admin.countries')->with('success', 'Country added successfully');
}

public function notifications()
    {

        // Logic to retrieve notifications
        // For example, you might fetch notifications from a database
        $notifications = []; // Replace with actual logic to fetch notifications

        return view('admin.notifications', compact('notifications'));
    }

}
