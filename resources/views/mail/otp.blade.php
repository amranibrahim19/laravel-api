<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #ff6f61;
            text-align: center;
            margin: 20px 0;
        }

        .email-footer {
            text-align: center;
            margin-top: 30px;
            color: #888;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Your OTP Code</h2>
        </div>
        <p>Hello ,</p>
        <p>Please use the following OTP code to complete your action:</p>
        <div class="otp-code">
            {{ $otp }}
        </div>
        <p>This code is valid for the next 10 minutes. Please do not share this code with anyone.</p>
        <p>If you did not request this OTP, please contact our support team immediately.</p>
        <div class="email-footer">
            <p>Thank you for using our service.</p>
            <p>&copy; {{ date('Y') }} Your Company Name</p>
        </div>
    </div>
</body>

</html>