<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Edit User</title>
    <script>
        function confirmUpdate(event) {
            const confirmation = confirm("Are you sure you want to update this record?");
            if (!confirmation) {
                event.preventDefault(); // Prevent form submission if the user cancels
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
    </section>

    <content class="manage_users">
        <h1 style="color:#FF6B35;">Edit User</h1>
        <hr>
        <form method="POST" action="{{ route('update.user', $user->id) }}" onsubmit="confirmUpdate(event)">
            @csrf
            @method('PUT')
            <label for="name">Name</label>
            <input type="text" id="s-box" class="s-box" name="name" value="{{ old('name', $user->name) }}" required><br>

            <label for="email">Email</label>
            <input type="email" id="s-box" class="s-box" name="email" value="{{ old('email', $user->email) }}" required><br>

            <label for="gender">Gender</label>
            <select id="s-box" class="s-box" name="gender">
                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            <br>
            <button type="submit" id="s-button">Update</button>
            <button type="button" id="s-button" onclick="window.location.href='{{ url('admin/dashboard') }}'">Cancel</button>
        </form>
    </content>
</body>
</html>
