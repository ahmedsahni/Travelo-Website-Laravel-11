<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Countries</title>
    <script>
        function confirmDeletion(countryId) {
            const confirmation = confirm("Do you really want to delete this country?");
            if (confirmation) {
                window.location.href = "{{ url('admin/countries/delete') }}/" + countryId;
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
            <li><a href="{{ url('admin/dashboard') }}">Admin Dashboard</a></li>
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
    <h1 style="color:#FF6B35;">Manage Countries</h1>
    <hr>

    @if(Auth::user()->role == 1)
    <form method="POST" action="{{ route('countries.store') }}" enctype="multipart/form-data">
        @csrf
        <input id="s-box" class="s-box" type="text" name="name" placeholder="Country Name" required>
        <input id="s-box" class="s-box" type="text" name="price" placeholder="Price" required>
        <input class="s-box" type="file" name="image" accept="image/*" required>
        <button id="s-button" type="submit">Add Country</button><br><br>
    </form>
@endif

    <div style="display: flex">
    @foreach($countries as $country)
        <div class="inner_offer_box">
            <img src="{{ asset('uploads/' . $country->image) }}" alt="Image of {{ $country->name }}">
            <h3>{{ $country->name }}</h3>
            <div class="price">
                <p>RS {{ $country->price }}</p>
            </div>
            @if(Auth::user()->role == 1)
            <button onclick="confirmDeletion({{ $country->id }})">Delete</button>
            @endif
        </div>
    @endforeach
</div>
</content>
</body>
</html>
