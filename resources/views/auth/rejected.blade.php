<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Rejected</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f9f9f9;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        h1 {
            color: #e74c3c;
        }
        p {
            color: #555;
            line-height: 1.5;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Rejected</h1>
        <p>We regret to inform you that your account has been rejected. If you believe this is an error, please contact support.</p>
        <p><a href="{{ url('/') }}">Return to Home</a></p>
    </div>
</body>
</html>
