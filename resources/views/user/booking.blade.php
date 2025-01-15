<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
    <title>Book Your Service</title>
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
                <a href="#about">
                    <li>About Us</li>
                </a>
                <a href="{{ route('user.profile') }}">
                    <li>Profile</li>
                </a>
                <a href="{{ route('logout') }}">
                    <li>Logout</li>
                </a>
            </ul>
        </div>
    </header>

    <h1 id="booking-heading" style="text-align: center; color:#FFD166;">Book your Service</h1>

    <section class="book">
        <div class="upper-tick">
            <div class="tick">
                <div class="inner-tick">
                    <img src="{{ asset('pictures/tick.jpg') }}" alt="">
                </div>
                <p>Travel Area</p>
            </div>
            <div class="tick">
                <div class="inner-tick">
                    <img src="{{ asset('pictures/tick.jpg') }}" alt="">
                </div>
                <p>Booking Details</p>
            </div>
            <div class="tick">
                <div id="third" class="inner-tick">
                    <p>3</p>
                </div>
                <p>Complete</p>
            </div>
        </div>
        <hr>

        <div class="search">
            <p>Traveling to:</p>
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <!-- Disabled Dropdown for Destination -->
                <select name="citybox" class="city" disabled>
                    <option value="{{ $destination }}" selected>{{ $destination }}</option>
                </select>

                <!-- Hidden Input to Pass Destination Value -->
                <input type="hidden" name="citybox" value="{{ $destination }}">

                <p>Job Name (Required)</p>
                <input class="city" type="text" name="job_name" required>

                <p>Select Travel Type (Required)</p>
                <select name="request_type" class="abc" required>
                    <option value="Business">Business</option>
                    <option value="Leisure">Leisure</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Cultural">Cultural</option>
                    <option value="Family">Family</option>
                </select>

                <div class="setdate">
                    <p>Set Date</p>
                    <input type="date" name="date" required>
                </div>

                <!-- Hidden input for email -->
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">

                <div class="buttons">
                    <button style="background-color: #FF6B35; color:white" type="submit">Submit</button>
                </div>
            </form>



            @if (session('success'))
                <div id="popupBox" class="popup-box" style="display: block;">
                    <div class="popup-content">
                        <span class="close-btn" id="closePopup">&times;</span>
                        <p>You have been registered for {{ session('travel_type') }} travel type, for
                            {{ session('travel_date') }}, in {{ session('city') }}. Please check your email</p>
                    </div>
                </div>
            @endif



            <!-- Error Message Box -->
            @if ($errors->any())
                <div class="message-box" id="errorMessageBox"
                    style="display: block; background-color: #FF6B35; color: white;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="map">
            <img id="map-img" src="{{ asset('images/maps.png') }}" alt="Map Image">
        </div>
    </section>

</body>

</html>
<script>
    document.getElementById("closePopup").onclick = function() {
    document.getElementById("popupBox").style.display = "none";
};

// If you want the pop-up to automatically close after a few seconds, you can add this:
setTimeout(function() {
    document.getElementById("popupBox").style.display = "none";
}, 5000); // 5 seconds

</script>
