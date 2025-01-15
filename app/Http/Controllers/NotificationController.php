<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Retrieve all notifications
        $notifications = Notification::all();

        // Return the view with notifications
        return view('admin.notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'notification' => 'required|string|max:255',
        ]);

        // Create a new notification
        Notification::create([
            'message' => $request->notification,
            'user_id' => auth()->user()->id, // Include user_id
        ]);

        return redirect()->back()->with('success', 'Notification created successfully.');
    }

    public function destroy($id)
    {
        // Find the notification and delete it
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}
