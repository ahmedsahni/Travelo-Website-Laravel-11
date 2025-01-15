<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myTravels.css') }}">
    <title>My Travels</title>
</head>

<body>
    <header>
        <div class="logo">
            <h2>Travelo</h2>
        </div>
        <div class="head">
            <ul>
                <a href="{{ route('user.main') }}"><li>Home</li></a>
                <a href=""><li style="color: #FFD166;">My Travels</li></a>
                <a href="#services"><li>Services</li></a>
                <a href="#about"><li>About Us</li></a>
                <a href="{{ route('logout') }}"><li>Logout</li></a>
                <a href="{{ route('user.profile') }}">
                    <li>
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="propic">
                    </li>
                </a>
            </ul>
        </div>
    </header>

    <section class="jobs">
        <h1>My Travels</h1>
        <hr>
        @if(auth()->check())
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Email</th>
                        <th>Job name</th>
                        <th>Destination</th>
                        <th>Travel Type</th>
                        <th>Booking Date</th>
                        <th>Created At</th>
                        <th>Action</th> <!-- Added Action Column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->email }}</td>
                            <td>{{ $booking->job_name }}</td>
                            <td>{{ $booking->city }}</td>
                            <td>{{ $booking->request_type }}</td>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->created_at }}</td>
                            <td>
                                <!-- Delete Button -->
                                <form action="{{ route('delete.booking', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                    @csrf
                                    @method('DELETE')
                                    <button id="s-button" type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>You are not logged in. Please <a href="{{ route('login') }}">log in</a> to view your travels.</p>
        @endif
    </section>
</body>

</html>
