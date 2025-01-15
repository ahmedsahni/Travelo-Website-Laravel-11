<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    <header>
        <div class="logo">
            <h2>Travelo</h2>
        </div>
        <div class="head">
            <ul>
                <a href="{{ route('signup') }}">
                    <li>Create Account</li>
                </a>
            </ul>
        </div>
    </header>

    <section class="create">
        <div class="portion1">
            @if (session('error'))
                <div style="color: red;">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif
            <form action="{{ route('login.process') }}" method="post">
                @csrf
                <h1>Log in to <span style="color:#FF6B35;">Travello</span></h1>
                <p>Email:</p>
                <input type="email" name="email" placeholder="Enter your email" required>
                <p>Password:</p>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <br><br>
                <input type="submit" value="Login">
            </form>
        </div>
        <div class="portion2">
            <img src="{{ asset('images/pngtree-3d-suitcase-stereo-element-png-image_2189848-removebg-preview.png') }}" alt="">
        </div>
    </section>
</body>
</html>
