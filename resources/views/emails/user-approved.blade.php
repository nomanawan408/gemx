<!DOCTYPE html>
<html>
<head>
    <title>Your Account Has Been Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .email-header {
            background: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        .email-body {
            padding: 20px;
        }
        .email-body h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .email-body p {
            font-size: 16px;
            margin: 10px 0;
        }
        .email-footer {
            text-align: center;
            background: #f4f4f9;
            padding: 10px;
            font-size: 14px;
            color: #666;
        }
        .btn {
            display: inline-block;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Account Approved!</h1>
        </div>
        <div class="email-body">
            <h1>Welcome, {{ $user->name }}!</h1>
            <p>We are excited to let you know that your account has been approved. You can now access our platform and explore all the amazing features we offer.</p>
            <p>Feel free to log in to your account and start using our services right away.</p>
            <a href="{{ url('/login') }}" class="btn">Go to Dashboard</a>
            <p>If you have any questions or need assistance, don’t hesitate to contact our support team.</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} PKGJS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
