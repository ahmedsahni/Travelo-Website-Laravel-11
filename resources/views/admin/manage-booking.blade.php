<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Manage Bookings</title>
    <script>
        function confirmDeletion(bookingId) {
    const confirmation = confirm("Do you really want to delete this entry?");
    if (confirmation) {
        // Create a form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ url('admin/manage-booking/delete') }}/" + bookingId;

        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Add the DELETE method
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        // Append the form to the body and submit it
        document.body.appendChild(form);
        form.submit();
    }
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
            <h3><a href="{{ url('admin/manage-booking') }}">Bookings</a></h3>
        </div>
        <div class="buttons">
            <img src="{{ asset('dahboard_icons/profile-icon-png-915.png') }}" alt="Countries">
            <h3><a href="{{ url('admin/countries') }}">Countries</a></h3>
        </div>
    </section>

    <content class="manage_users">
        <h1 style="color:#FF6B35;">Bookings</h1>
        <hr>

        <form method="GET" action="{{ url('admin/manage-booking') }}">
            <input id="s-box" type="text" name="search" placeholder="Search by User Name or Request Type"
                value="{{ request('search') }}">
            <button id="s-button" type="submit">Search</button>
        </form>

        @if (Auth::check())
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Job Name</th>
                        <th>Request Type</th>
                        <th>Date</th>
                        <th>Destination</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->user ? $booking->user->name : 'No User' }}</td>
                            <td>{{ $booking->user ? $booking->user->email : 'No Email' }}</td>
                            <td>{{ $booking->job_name }}</td>
                            <td>{{ $booking->request_type }}</td>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->city }}</td>
                            @if (auth()->user()->role == 1)
                                <td>
                                    <button class="action-button edit-button"
    onclick="alert('Edit button clicked'); window.location.href='{{ url('admin/manage-booking/edit', $booking->id) }}'">Edit</button>
                                    <button class="action-button delete-button"
                                        onclick="confirmDeletion({{ $booking->id }})">Delete</button>
                                </td>
                            @else
                                <!-- Handle other roles here if needed -->
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No bookings available.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        @else
            <p>You are not logged in. Please <a href="{{ route('login') }}">log in</a> to manage bookings.</p>
        @endif
    </content>
</body>

</html>
