<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/join.css') }}">
    <title>Signup</title>
</head>
<body>
    <header>
        <div class="logo">
            <h2>Travelo</h2>
        </div>
        <div class="head">
            <ul>
                <a href="{{ route('login') }}">
                    <li>Login</li>
                </a>
                <a href="#">
                    <li style="color: rgb(7, 231, 7);">Create Account</li>
                </a>
            </ul>
        </div>
    </header>

    <section class="create">
        <div class="portion1">
            @if (Session::has('success'))
                <div style="color: green;">{{ Session::get('success') }}</div>
            @endif

            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('signup.process') }}" method="POST">
                @csrf
                <h1>Create <span style="color:#FFD166;">Account</span></h1>
                <p>Full name *</p>
                <input type="text" name="name" placeholder="Name" required>

                <p>Mobile number *</p>
                <input type="text" name="number" placeholder="Mobile number" required>

                <p>Gender *</p>
                <input type="radio" name="gender" value="male" required> Male
                <input type="radio" name="gender" value="female" required> Female
                <input type="radio" name="gender" value="other" required> Other

                <p>Email *</p>
                <input type="email" name="email" placeholder="Email" required>

                <p>Password *</p>
                <input type="password" name="password" placeholder="Password" required>

                <p>Confirm Password *</p>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>

                <input type="checkbox" required>I agree to Terms and Conditions and accept Privacy policy <br><br>
                <input type="submit" value="Submit">
            </form>
        </div>

        <div class="portion2">
            <img src="{{ asset('images/bgc.png') }}" alt="">
        </div>
    </section>
</body>
</html>
