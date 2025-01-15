<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Edit Booking</title>
    <script>
        function confirmUpdate() {
            const confirmation = confirm("Do you really want to update this booking?");
            return confirmation;
        }
    </script>
</head>
<body>
<header>
    <div class="logo">
        <h2>Travelo</h2>
    </div>
    <div class="head">
        <ul>
            <li>Admin Dashboard</li>
            <a href="{{ route('logout') }}">
                <li>Logout</li>
            </a>
        </ul>
        <a href="#">
            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('pictures/80-805068_my-profile-icon-blank-profile-picture-circle-clipart.png') }}" alt="Profile Picture" class="propic">
        </a>
    </div>
</header>

<section class="dashboard">
    <div class="buttons">
        <img src="{{ asset('dahboard_icons/—Pngtree—home icon simple  symbol_3566359.png') }}" alt="Home">
        <h3><a href="{{ url('admin/dashboard') }}">Dashboard</a></h3>
    </div>
    <div class="buttons">
        <img src="{{ asset('dahboard_icons/booking.png') }}" alt="Bookings">
        <h3><a href="{{ url('admin.manage-booking.index') }}">Bookings</a></h3>
    </div>
</section>

<content class="manage_users">
    <h1 style="color:#FF6B35;">Edit Booking</h1>
    <hr>

    <form method="POST" action="{{ url('admin.manage-booking.update', $booking->id) }}" onsubmit="return confirmUpdate()">
        @csrf
        @method('PUT')

        <input id="s-box" type="text" name="job_name" value="{{ old('job_name', $booking->job_name) }}" placeholder="Job Name" required>
        <input id="s-box" type="text" name="request_type" value="{{ old('request_type', $booking->request_type) }}" placeholder="Request Type" required>
        <input id="s-box" type="date" name="date" value="{{ old('date', $booking->date) }}" required>
        <input id="s-box" type="text" name="city" value="{{ old('city', $booking->city) }}" placeholder="City" required>

        <button id="s-button" type="submit" name="update_booking">Update</button>
    </form>
</content>
</body>
</html>
