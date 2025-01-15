<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Document</title>
</head>
<body>
  <header>
    <div class="navbar">
      <div class="title">
        <h2>Travelo</h2>
      </div>
      <div class="home">
        <ul>
          <li>Home</li>
          <li>About Us</li>
          <li>Blog</li>
          <li>Contact</li>
        </ul>
      </div>
      <div class="log">
        <button class="auth" onclick="login()">Log In</button>
        <button class="auth" onclick="signup()" style="background-color: #FFD166; border:none">Sign Up</button>
      </div>
    </div>
  </header>
  <section class="a1">
    <div class="a1-a">
      <h2>Let's Make Your <span style="color: white;">Best Trip</span> Ever.</h2>
      <p>Unlock your next adventure with <span style="color: #FFD166;">Travelo</span>. Explore mesmeriezing
       destinations, curated experiences, and seamless planning. Your journey starts here.</p>
    </div>
    <div class="a1-b">
        <img src="{{ asset('images/Group 38.png') }}" alt="">

    </div>
  </section>
  <div class="data">
    <form action="">
    <div class="b1">
      <img src="" alt="">
    </div>
    <div class="b2">
      <img src="" alt="">
    </div>
    <div class="b3"></div>
  </div>
  <section class="a2">
    <div class="a2-a">
      <img src="{{ asset('images/Group 40.png') }}" alt="">
    </div>
    <div class="a2-b">
      <div class="a2-b1">
        <h2>Explore all corners of <span style="color:red">the world</span>
        with us</h2>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eos accusantium cumque enim, ullam quisquam corrupti voluptas veritatis, amet vel laborum et exercitationem magni recusandae qui id commodi adipisci rerum non reiciendis harum, ea deserunt.</p>
      </div>
      <div class="a2-b2">
        <img src="{{ asset('images/Group 47.png') }}" alt="">
      </div>
    </div>
  </section>
  <section class="a3">
    <div class="a3-a">
      <div class="a3-a1">
        <h2>Grab Your <span style="color: white;">Tickets</span></h2>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Placeat dolorum cum laboriosam a accusamus reiciendis aperiam modi quibusdam eligendi vitae.</p>
      </div>
      <div class="a3-a2">
        <img src="{{ asset('images/Group 26.png') }}" style="transform: scaleX(-1);" alt="">
        <img src="{{ asset('images/Group 26.png') }}" alt="">
      </div>
    </div>
    <div class="a3-b">
      <img src="{{ asset('images/Group 21.png') }}" alt="">
      <img src="{{ asset('images/Group 41.png') }}" alt="">
      <img src="{{ asset('images/Group 21.png') }}" alt="">
    </div>
  </section>
  <section class="a4">
    <div class="a4-a">
      <div class="a4-a1">
        <h2>What people are <span style="color: red;">saying </span>about us</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus minus voluptate laboriosam veniam repellat praesentium ipsa expedita libero, necessitatibus quibusdam.</p>
      </div>
      <div class="a4-a2">
        <img src="{{ asset('images/Group 51.png') }}" alt="">
      </div>
    </div>
    <div class="a4-b">
      <img src="{{ asset('images/Rectangle 24.png') }}" alt="">
    </div>
  </section>
  <section class="a5">
    <div class="about">
      <h2>Travelo</h2>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sunt, velit!</p>
    </div>
    <div class="a5-1">
      <h3>About Us</h3>
      <p>About Us</p>
      <p>Destinations</p>
      <p>News & Articles</p>
      <p>Testimonials</p>
    </div>
    <div class="a5-2">
      <h3>Help</h3>
      <p>FAQ</p>
      <p>Privacy Policy</p>
    </div>
    <div class="a5-3">
      <h3>Features</h3>
      <p>Payment</p>
      <p>Account</p>
      <p>Referral Bonus</p>
    </div>
    <div class="a5-4">
      <h3>Company</h3>
      <p>Carrers</p>
      <p>Privacy</p>
      <p>Partners</p>
    </div>
  </section>
</body>
</html>
<script>
function login() {
    window.location.href = "{{ route('login') }}";
}

function signup() {
    window.location.href = "{{ route('signup') }}";
}

</script>
