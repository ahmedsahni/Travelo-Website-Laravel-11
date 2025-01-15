<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Main Page</title>
    <style>
        .notification-panel {
            display: none;
            position: absolute;
            top: 50px;
            right: 10px;
            background: linear-gradient(135deg, #FFD166, #FF6B35);
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            z-index: 1000;
            max-height: 300px;
            overflow-y: auto;
        }

        .notification-panel h3 {
            margin-top: 0;
        }

        .notification {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .notification:last-child {
            border-bottom: none;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h2>Travelo</h2>
        </div>
        <div class="head">
            <ul>
                <li><a href="{{ route('home') }}" style="color: #FFD166;">Home</a></li>
                <li><a href="{{ route('user.myTravels') }}">My Travels</a></li>
                <li><a href="{{ route('chat') }}">Chat</a></li>
                <li><a href="#" id="notificationsLink">Notifications</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
                <li><a href="{{ route('user.profile') }}">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('pictures/80-805068_my-profile-icon-blank-profile-picture-circle-clipart.png') }}" alt="Profile Picture" class="propic">
                </a></li>
            </ul>
        </div>
    </header>

    <div class="notification-panel" id="notificationPanel">
        <button class="close-btn" id="closeNotificationPanel">&times;</button>
        <h3>Notifications</h3>
        <div id="notificationContent">
            @foreach ($notifications as $notification)
                <div class="notification">
                    <p>{{ $notification->message }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <nav>
        <div class="nav1">
            <h1>Let's Make Your Best Trip Ever.</h1>
            <input class="search_item" type="search" id="countrySearch" placeholder="Search the area you want to travel!">
        </div>
        <div class="nav2">
            <img src="{{ asset('images/img_1-removebg-preview.png') }}" alt="no found">
        </div>
    </nav>

    <section class="weekly-offer">
        <h1>Weekly Offers</h1>
        <p>Select the city in which you need service</p>
        <select name="citybox" class="city">
            <option value="Europe">Europe</option>
            <option value="Spain">Spain</option>
            <option value="New york">NY</option>
            <option value="Bangkok">Bangkok</option>
            <option value="London">London</option>
            <option value="Karachi">Karachi</option>
            <option value="Islamabad">Islamabad</option>
            <option value="Faisalabad">Faisalabad</option>
        </select>

        <div class="outer_offer_box" id="services">
            @foreach ($countries as $country)
                <div class="inner_offer_box">
                    <img src="{{ asset('uploads/' . $country->image) }}" alt="Image of {{ $country->name }}">
                    <h3>{{ $country->name }}</h3>
                    <div class="price">
                        <p>RS {{ $country->price }}</p>
                        <p style="color: green;">Editor's Choice</p>
                    </div>
                    <a href="{{ route('user.booking', ['country_id' => $country->id]) }}"><button>Book Now</button></a>

                </div>
            @endforeach
        </div>
    </section>

    <footer id="about">
        <div class="upper">
            <div class="inner-footer">
                <h2>Services</h2>
                <a href=""><p>World Travel Services</p></a>
                <a href=""><p>Explore the world</p></a>
                <a href=""><p>Europian Channel</p></a>
                <a href=""><p>New york Times</p></a>
            </div>
            <div class="inner-footer">
                <h2>Menu</h2>
                <a href=""><p>FAQ</p></a>
                <a href=""><p>About Us</p></a>
                <a href=""><p>Rewards</p></a>
                <a href=""><p>Contact Us</p></a>
                <a href=""><p>Blogs</p></a>
                <a href=""><p>Privacy Policy</p></a>
                <a href=""><p>Terms And Conditions</p></a>
            </div>
            <div class="inner-footer">
                <h2>Follow us</h2>
                <a href="https://www.facebook.com/ahmed.sahni.37/"><p>Facebook</p></a>
                <a href=""><p>YouTube</p></a>
                <a href="https://twitter.com/home?lang=en"><p>Twitter</p></a>
                <a href="https://www.linkedin.com/in/muhammad-ahmed-sahni-525301294/"><p>LinkedIn</p></a>
                <a href="https://www.instagram.com/dearahmed._/"><p>Instagram</p></a>
                <a href=""><p>Tiktok</p></a>
            </div>
            <div class="inner-footer">
                <h2>Enter Your mail to receive Emails</h2>
                <div class="e_mail">
                    <input type="email" placeholder="Email" style="font-size: larger;">
                    <a href=""><img src="{{ asset('pictures/send1.png') }}" alt=""></a>
                </div>
                <h2>Download Travello app on</h2>
                <a href=""><img class="img-1" src="{{ asset('pictures/app.png') }}" alt=""></a>
                <a href=""><img class="img-2" src="{{ asset('pictures/playstor.png') }}" alt=""></a>
            </div>
        </div>
        <div class="lower">
            <hr>
            <h5>Copyright ©2023 Travello Pvt Ltd.</h5>
        </div>
    </footer>

    <script>
        document.getElementById('notificationsLink').addEventListener('click', function() {
            document.getElementById('notificationPanel').style.display = 'block';
        });

        document.getElementById('closeNotificationPanel').addEventListener('click', function() {
            document.getElementById('notificationPanel').style.display = 'none';
        });
    </script>
</body>

</html>
<script>
    document.getElementById('notificationsLink').addEventListener('click', function() {
        document.getElementById('notificationPanel').style.display = 'block';
    });

    document.getElementById('closeNotificationPanel').addEventListener('click', function() {
        document.getElementById('notificationPanel').style.display = 'none';
    });

    // Search functionality
    document.getElementById('countrySearch').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const countries = document.querySelectorAll('.inner_offer_box');

        countries.forEach(country => {
            const countryName = country.querySelector('h3').textContent.toLowerCase();
            if (countryName.includes(searchValue)) {
                country.style.display = 'flex'; // Show the country
            } else {
                country.style.display = 'none'; // Hide the country
            }
        });
    });
</script>
