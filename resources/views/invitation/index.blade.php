@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Invitation Letter</h3>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card">
                <div class="card-body text-center" style="background: linear-gradient(to right, #e0f7e9, #a8d5ba); border-radius: 15px; padding: 30px; box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);">
                    <h1 class="fw-bold" style="color: #2e7d32;">You're Invited!</h1>
                    <p class="mt-3" style="color: #1b5e20; font-size: 1.1rem; line-height: 1.6;">
                        Join us for an unforgettable celebration of creativity, innovation, and connection in a vibrant atmosphere.
                    </p>
                    <div class="mt-4">
                        <h2 style="color: #2e7d32;">Event Details</h2>
                        <p style="font-size: 1rem; color: #1b5e20;">
                            <strong>Date:</strong> 02-04 May, 2025<br>
                            <strong>Time:</strong> 9:30 AM<br>
                            <strong>Venue:</strong> Sareena Hotel
                        </p>
                    </div>

                    <div class="mt-4" style="border-top: 2px dashed #2e7d32; padding-top: 20px;">
                        <h2 style="color: #2e7d32;">Dress Code</h2>
                        <p style="font-size: 0.9rem; color: #1b5e20;">Formal Attire</p>
                    </div>

                    <div class="mt-4" style="border-top: 2px dashed #2e7d32; padding-top: 20px;">
                        <h2 style="color: #2e7d32;">RSVP</h2>
                        <p style="font-size: 0.9rem; color: #1b5e20;">
                          
                            Contact us at <strong style="color: #2e7d32;">info@pkgjs.com</strong> or call <strong style="color: #2e7d32;">+92 307 1356666</strong>.
                        </p>
                    </div>

                    <a href="{{ route('invitation.download') }}" class="btn btn-success mt-4" style="border-radius: 30px; padding: 10px 20px; font-size: 1rem;">
                        Download Invitation
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
