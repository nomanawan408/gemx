<!DOCTYPE html>
<html>
<head>
    <title>Accommodation Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        h3 {
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h3>Accommodation Details</h3>
        <p>Dear {{ $accommodation->user->name }},</p>
        <p>We are pleased to inform you that your accommodation details have been successfully added. Below are the details:</p>
        <table>
            <tr>
                <th>Hotel Name</th>
                <td>{{ $accommodation->hotel_name }}</td>
            </tr>
            <tr>
                <th>Room Number</th>
                <td>{{ $accommodation->room_no }}</td>
            </tr>
            <tr>
                <th>Check-in Time</th>
                <td>{{ \Carbon\Carbon::parse($accommodation->check_in_time)->format('d-m-Y H:i A') }}</td>
            </tr>
        </table>
        <p>If you have any questions, please feel free to contact our hospitality team.</p>
        <p>Thank you,</p>
        <p>The Hospitality Team</p>
        <div class="footer">
            <p>Note: This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>
</body>
</html>
