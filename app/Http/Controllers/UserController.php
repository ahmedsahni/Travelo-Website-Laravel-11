<?php

namespace App\Http\Controllers;


use App\Models\Country;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Booking; // Ensure this is correct

class UserController extends Controller
{
    public function index()
    {
        return view('index'); // Ensure this matches the name of your view file
    }

public function mainPage()
{
    // Retrieve all notifications
    $notifications = Notification::all();

    // Retrieve the countries to display on the main page
    $countries = Country::all();

    return view('user.main', compact('notifications', 'countries'));
}
    public function home()
    {
        return view('user.main'); // Assuming the home page view is named main.blade.php in the user folder
    }

    public function viewCountries()
    {
        return view('user.countries');
    }

    public function showBookingForm($country_id)
    {
        return view('user.booking', compact('country_id'));
    }

    public function myTravels()
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to log in to view your travels.');
        }

        // Fetch the bookings for the authenticated user
        $bookings = Booking::where('user_id', auth()->id())->get();

        // Return the view with the bookings data
        return view('user.myTravels', compact('bookings'));
    }

    public function profile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Return the profile view with the user data
        return view('user.profile', compact('user'));
    }


    public function notifications()
    {
        return view('user.notifications');
    }
}
