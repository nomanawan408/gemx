<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
</head>
<body>
    <h1>Welcome, {{ $user->name }}!</h1>
    <p>Thank you for registering with us on the spot. Below are your details:</p>

    <div class="card shadow-lg" style="max-width: 600px; margin: auto; background: #f8f9fa; border-radius: 20px; overflow: hidden;">
        <div class="card-body" style="padding: 0;">
            <div style="background: #4caf50; color: white; padding: 20px; text-align: center;">
                <h1 class="fw-bold">Event Access Pass</h1>
            </div>
            <div style="padding: 20px; text-align: center;">
                <p style="font-size: 1.2rem; margin-bottom: 20px; color: #333;">
                    This pass grants you access to an exclusive event filled with creativity and innovation.
                </p>
                <div style="text-align: left; margin: 20px auto; max-width: 400px;">
                    <h3 style="color: #4caf50; margin-bottom: 10px; text-align: center;">Pass Details:</h3>
                    <p style="text-align: center; margin: 0; font-size: 1rem; color: #555;">
                        <strong>Name:</strong> {{ $user->name}}<br>
                        <strong>Event:</strong> Pakistan Gems & Jewerly Show 2025<br>
                        <strong>Date:</strong> 02-04 May, 2025<br>
                        <strong>Time:</strong> 9:30 AM<br>
                        <strong>Venue:</strong> Sareena Hotel
                    </p>
                </div>
                <div style="border-top: 2px solid #4caf50; margin-top: 20px; padding-top: 20px;">
                    <h3 style="color: #4caf50; margin-bottom: 10px;">Important Notes:</h3>
                    <p style="font-size: 0.9rem; color: #555;">
                        This pass is valid for one individual only. Please carry a valid photo ID.<br>
                        For any issues, contact us at <strong>info@pkgjs.com</strong> or call <strong>+92 307 1356666</strong>.
                    </p>
                </div>
                <a href="{{ route('invitation.download') }}" class="btn btn-success mt-4" style="border-radius: 10px; padding: 15px 30px; font-size: 1rem;">
                    Download Pass
                </a>
            </div>
        </div>
    </div>

    <p>We are excited to have you on board. If you have any questions, feel free to reach out!</p>

    <p>Best Regards,<br>The Team</p>
</body>
</html>
