<?php

namespace App\Http\Controllers;

use App\Models\Country;  // Assuming you have a Country model
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;


use App\Models\Booking;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::when($request->search, function ($query) use ($request) {
            return $query->where('job_name', 'like', '%' . $request->search . '%')
                         ->orWhereHas('user', function ($q) use ($request) {
                             $q->where('name', 'like', '%' . $request->search . '%');
                         });
        })->get();

        return view('admin.manage-booking', compact('bookings'));
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function edit($id)
    {
        // Find the booking by ID
        $booking = Booking::findOrFail($id);

        // Return the edit view with the booking data
        return view('admin.edit-booking', compact('booking'));
    }
    public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'job_name' => 'required|string|max:255',
        'request_type' => 'required|string|max:255',
        'date' => 'required|date',
        'city' => 'required|string|max:255',
    ]);

    // Find the booking and update it
    $booking = Booking::findOrFail($id);
    $booking->job_name = $request->job_name;
    $booking->request_type = $request->request_type;
    $booking->date = $request->date;
    $booking->city = $request->city;
    $booking->save();

    // Redirect back to the bookings page with a success message
    return redirect()->route('manage-booking.index')->with('success', 'Booking updated successfully.');
}
public function destroy($id)
{
    $booking = Booking::findOrFail($id);
    $booking->delete();

    return redirect()->route('admin.manage-booking.index')->with('success', 'Booking deleted successfully.');
}
public function indexBooking($country_id)
{
    $country = Country::findOrFail($country_id); // Fetch country by ID
    $destination = $country->name; // Assuming the 'name' field holds the country name

    return view('user.booking', compact('destination'));
}

    // Handle the form submission to store the booking
    public function storeBooking(Request $request)
    {
        // Validate request
        $request->validate([
            'citybox' => 'required|string',
            'job_name' => 'required|string|max:255',
            'request_type' => 'required|string',
            'date' => 'required|date',
            'email' => 'required|email',
        ]);

        // Save booking to the database
        $booking = Booking::create([
            'city' => $request->input('citybox'),
            'job_name' => $request->input('job_name'),
            'request_type' => $request->input('request_type'),
            'date' => $request->input('date'),
            'email' => $request->input('email'),
            'user_id' => auth()->id(),
        ]);

        // Prepare data for the email
        $data = [
            'destination' => $request->input('citybox'),
            'jobName' => $request->input('job_name'),
            'requestType' => $request->input('request_type'),
            'travelDate' => $request->input('date'),
            'email' => $request->input('email'),
        ];

        // Send confirmation email
        Mail::to($request->input('email'))->send(new BookingConfirmation($data));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Booking registered successfully!')
            ->with('travel_type', $request->input('request_type'))
            ->with('travel_date', $request->input('date'))
            ->with('city', $request->input('citybox'));
    }

public function deleteBooking($id)
{
    $booking = Booking::findOrFail($id);
    $booking->delete();

    return redirect()->route('user.myTravels')->with('success', 'Booking deleted successfully!');
}


}



