<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Travel Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        ul {
            padding-left: 20px;
        }
        li {
            margin-bottom: 10px;
        }
        strong {
            color: #333;
        }
        p {
            color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Confirmation</h1>
        <p>Dear {{ $email }},</p>
        <p>You have been successfully registered for a booking to <strong>{{ $destination }}</strong> with the following details:</p>
        <ul>
            <li><strong>Job Name:</strong> {{ $jobName }}</li>
            <li><strong>Travel Type:</strong> {{ $requestType }}</li>
            <li><strong>Travel Date:</strong> {{ $travelDate }}</li>
        </ul>
        <p>Thank you for using Travelo!</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Travelo. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
