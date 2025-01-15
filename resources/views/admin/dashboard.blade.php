<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Dashboard</title>
    <script>
        function confirmDeletion(userId) {
            const confirmation = confirm("Do you really want to delete this entry? This will also delete their corresponding bookings.");
            if (confirmation) {
                // Create a form to send a POST request to delete the user
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('admin.deleteUser') }}';

                // CSRF Token (Laravel requires this for POST requests)
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                // User ID to delete
                const userIdInput = document.createElement('input');
                userIdInput.type = 'hidden';
                userIdInput.name = 'delete_id';
                userIdInput.value = userId;
                form.appendChild(userIdInput);

                // Append the form to the body and submit
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
        @if(auth()->check() && auth()->user()->role == 1)  <!-- Check if user is admin -->
            <div class="buttons">
                <img src="{{ asset('dahboard_icons/—Pngtree—home icon simple  symbol_3566359.png') }}" alt="">
                <h3><a href="{{ url('admin/dashboard') }}">Dashboard</a></h3>
            </div>
            <div class="buttons">
                <img src="{{ asset('dahboard_icons/booking.png') }}" alt="">
                <h3><a href="{{ route('admin.manage-booking.index') }}">Bookings</a></h3>

            </div>
            <div class="buttons">
                <img src="{{ asset('dahboard_icons/profile-icon-png-915.png') }}" alt="">
                <h3><a href="{{ route('admin.countries') }}">Countries</a></h3>
            </div>
            <div class="buttons">
                <img src="{{ asset('dahboard_icons/icon-admin.png') }}" alt="">
                <h3><a href="{{ route('notifications.index') }}">Notifications</a></h3>
            </div>
        @else
            <p>You do not have permission to access this page.</p>
        @endif
    </section>

    <content class="manage_users">
        <h1 style="color:#FF6B35;">Manage Users</h1>
        <hr>

        <form method="GET" action="{{ url('admin/dashboard') }}">
            <input id="s-box" type="text" name="search" placeholder="Search by Name" value="{{ request('search') }}">
            <button id="s-button" type="submit">Search</button>
        </form>

        @if (auth()->check())
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                @if (auth()->user()->role == 1)
                                <button class="action-button edit-button" onclick="window.location.href='{{ route('admin.edit-user', $user->id) }}'">Edit</button>

                                <button class="action-button delete-button" onclick="confirmDeletion({{ $user->id }})">Delete</button>

                                @else
                                    <button class="action-button edit-button" onclick="window.location.href='{{ route('admin.edit-user', $user->id) }}'">Edit</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @else
            <p>You are not logged in. Please <a href="{{ route('login') }}">log in</a> to manage users.</p>
        @endif
    </content>
</body>
</html>
