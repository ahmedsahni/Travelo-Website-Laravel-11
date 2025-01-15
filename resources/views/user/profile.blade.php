<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Edit Profile</title>
</head>
<body>
    <header>
        <div class="logo">
            <h2>Travelo</h2>
        </div>
        <div class="head">
            <ul>
                <a href="{{ route('user.main') }}">
                    <li>Home</li>
                </a>
                <a href="{{ route('user.myTravels') }}">
                    <li>My Travels</li>
                </a>
                <a href="">
                    <li>Services</li>
                </a>
                <a href="">
                    <li>About Us</li>
                </a>
                <a href="{{ route('user.profile') }}">
                    <li style="color: #FFD166;">Profile</li>
                </a>
                <a href="{{ route('logout') }}">
                    <li>Logout</li>
                </a>
            </ul>
        </div>
    </header>

    <section class="data">
        <div class="data-title">
            <h1>Edit Profile</h1>
            <hr>
        </div>
        <div class="data-form">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p>Full Name*</p>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

                <p>Phone Number*</p>
                <input type="tel" name="number" value="{{ old('number', $user->number) }}" required>

                <p>Email*</p>
                <input type="email" value="{{ $user->email }}" readonly>

                <p>Gender*</p>
                <input type="radio" name="gender" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}> Male
                <input type="radio" name="gender" value="female" {{ $user->gender == 'female' ? 'checked' : '' }}> Female
                <input type="radio" name="gender" value="other" {{ $user->gender == 'other' ? 'checked' : '' }}> Other

                <p>Profile Picture</p>
                <img id="pp-img" src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/default-profile.png') }}" alt="Profile Picture">
                <input type="file" name="image" accept="image/*">

                    <button style="background-color: #FF6B35; color:white; width: 100px; height: 50px; border: none; border-radius: 15px;" type="submit">Save</button>
            </form>
        </div>
    </section>
</body>
</html>
