<!DOCTYPE html>
<html>
<head>
    <title>Your Account Has Been Rejected</title>
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
            background: #f44336;
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
            background: #f44336;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #e53935;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Account Rejected</h1>
        </div>
        <div class="email-body">
            <h1>Hello, {{ $user->name }}!</h1>
            <p>We regret to inform you that your account application has been rejected. Unfortunately, you do not meet the criteria required to join our platform at this time.</p>
            <p>If you have any questions or need further information, please feel free to contact our support team.</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
