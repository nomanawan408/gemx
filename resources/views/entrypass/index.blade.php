@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Entry Pass</h3>
            </div>
        </div>
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
    </div>
</div>
@endsection