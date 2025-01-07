<!DOCTYPE html>
<html>
<head>
    <title>Flight Details</title>
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
    <div class="email-container" style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e5e5e5; border-radius: 8px; background-color: #f9f9f9;">
        <h3 style="color: #4CAF50;">Flight Details</h3>
        <p>Dear {{ $flight->user->name }},</p>
        <p>Your flight details have been successfully created. Below are the details:</p>
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">User ID</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $flight->user_id }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">Flight Number</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $flight->flight_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">Airline Name</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $flight->airline_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">Seat Number</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $flight->seat_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">Number of Persons</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $flight->no_of_persons ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">Departure Date & Time</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $flight->departure_date_time ? \Carbon\Carbon::parse($flight->departure_date_time)->format('d-m-Y H:i A') : 'N/A' }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">Arrival Date & Time</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($flight->arrival_date_time)->format('d-m-Y H:i A') }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">Pickup Terminal</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $flight->pickup_terminal }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #f2f2f2;">Dropoff Terminal</th>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $flight->dropoff_terminal }}</td>
            </tr>
        </table>
        <p>Thank you,</p>
        <p>The Hospitality Team</p>
        <div class="footer" style="margin-top: 20px; font-size: 0.9em; color: #666;">
            <p>Note: This is an automated email. Please do not reply to this message.</p>
        </div>
    </div>    
</body>
</html>

