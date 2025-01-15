<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Manage Notifications</title>
    <script>
        function confirmDeletion(notificationId) {
            const confirmation = confirm("Do you really want to delete this notification?");
            if (confirmation) {
                // Create a form to submit the delete request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ url('admin/notifications/delete') }}/" + notificationId;

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
        <h3><a href="{{ url('admin.manage-booking.index') }}">Bookings</a></h3>
    </div>
    <div class="buttons">
        <img src="{{ asset('dahboard_icons/profile-icon-png-915.png') }}" alt="Countries">
        <h3><a href="{{ url('admin.countries') }}">Countries</a></h3>
    </div>
    <div class="buttons">
        <img src="{{ asset('dahboard_icons/icon-admin.png') }}" alt="Notifications">
        <h3><a href="{{ url('admin.notifications') }}">Notifications</a></h3>
    </div>
</section>

<content class="manage_users">
    <h1 style="color:#FF6B35;">Manage Notifications</h1>
    <hr>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('notifications.store') }}">
        @csrf
        <textarea id="s-box" style="height: 100px; margin-bottom:0px" name="notification" placeholder="Enter notification message here" required></textarea>
        <button id="s-button" type="submit">Add</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Notification Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notifications as $notification)
                <tr>
                    <td>{{ $notification->message }}</td>
                    <td>
                        <button id="s-button" onclick="confirmDeletion({{ $notification->id }})">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No notifications found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</content>
</body>

</html>
