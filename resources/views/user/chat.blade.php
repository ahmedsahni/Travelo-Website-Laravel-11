<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat with GPT</title>
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #chat-container {
            display: flex;
            flex-direction: column;
            width: 500px;
            margin: 20px auto;
        }

        #chat-box {
            height: 400px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        #user-input {
            padding: 10px;
            width: 100%;
        }

        .message {
            margin-bottom: 10px;
        }

        .user-message {
            text-align: right;
            color: #4CAF50;
        }

        .bot-message {
            text-align: left;
            color: #2196F3;
        }

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
                <li><a href="#services">Services</a></li>
                <li><a href="#" id="notificationsLink">Notifications</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
                <li><a href="{{ route('user.profile') }}">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('pictures/80-805068_my-profile-icon-blank-profile-picture-circle-clipart.png') }}" alt="Profile Picture" class="propic">
                </a></li>
            </ul>
        </div>
    </header>

    <div id="chat-container">
        <h2>Chat with GPT</h2>
        <div id="chat-box"></div>
        <input type="text" id="user-input" placeholder="Type your message..." />
    </div>

    <div class="notification-panel" id="notificationPanel">
        <button class="close-btn" id="closeNotificationPanel">&times;</button>
        <h3>Notifications</h3>
    </div>

    <script>
        // Predefined answers object
        const predefinedAnswers = {
            "what is travelo": "Travelo is your ultimate travel companion, helping you book flights, accommodations, and activities.",
            "how do i book a trip": "To book a trip, simply log in, choose your destination, and select your travel dates.",
            "what are your services": "We provide flight bookings, hotel reservations, and local experiences.",
            "can i cancel my booking": "Yes, you can cancel your booking by visiting your 'My Travels' page and selecting the cancel option.",
            "hello": "Hi! How can I assist you today?",
            "bye": "Goodbye! Have a great day!"
        };

        // Function to send a predefined response
        function getPredefinedResponse(message) {
            // Convert the user message to lowercase to match with keys
            const messageLowerCase = message.toLowerCase();
            return predefinedAnswers[messageLowerCase] || "Sorry, I didn't understand that. Can you rephrase?";
        }

        // Handle user input and show message
        $('#user-input').on('keypress', function(event) {
            if (event.key === 'Enter' && $(this).val().trim() !== '') {
                const userMessage = $(this).val();
                $('#chat-box').append(`<div class="message user-message">${userMessage}</div>`);
                $('#user-input').val('');  // Clear input box
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);

                // Get predefined response
                const botMessage = getPredefinedResponse(userMessage);
                $('#chat-box').append(`<div class="message bot-message">${botMessage}</div>`);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });
    </script>
</body>

</html>
