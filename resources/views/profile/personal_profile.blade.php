@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3 text-primary">Profile</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ url()->previous() }}" class="btn btn-label-info btn-round me-2">Go Back</a>
                </div>
            </div>
            <div class="card shadow-sm bg-dark">
                <div class="card-body">
                    <div class="row d-flex align-items-center">
                        <!-- Profile Picture Section -->
                        <div class="col-md-4 d-flex justify-content-center">
                            <div class="d-flex flex-column align-items-center">
                                @if ($user->attachment && $user->attachment->personal_photo)
                                    <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}"
                                        style="height: 200px;width:200px;border-radius: 10px"
                                        alt="Profile Picture" class="img-fluid rounded-circle mb-3 border border-3 border-primary">
                                @else
                                    <div class="d-flex justify-content-center align-items-center rounded-circle bg-primary"
                                        style="height: 200px; width: 200px;">
                                        <span class="h1 text-white mb-0">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                                <h3 class="text-center pt-3 fw-bold text-light">{{ strtoupper($user->name) }}</h3>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <h4 class="fw-bold text-light">Personal Information</h4>
                            <hr class="text-primary">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="p-0 m-0">
                                        <p class="p-0 m-0 font-monospace text-decoration-underline text-light">Email:</p>
                                        <p class="ps-2 m-0 font-monospace text-light">{{ $user->email }}</p>
                                    </div>
                                    <div class="p-0 m-0">
                                        <p class="p-0 m-0 font-monospace text-decoration-underline text-light">Phone:</p>
                                        <p class="ps-2 m-0 font-monospace text-light">{{ $user->phone }}</p>
                                    </div>
                                    <div class="p-0 m-0">
                                        <p class="p-0 m-0 font-monospace text-decoration-underline text-light">Mobile:</p>
                                        <p class="ps-2 m-0 font-monospace text-light">{{ $user->mobile }}</p>
                                    </div>
                                    <div class="p-0 m-0">
                                        <p class="p-0 m-0 font-monospace text-decoration-underline text-light">Profession:</p>
                                        <p class="ps-2 m-0 font-monospace text-light">{{ $user->profession }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-0 m-0">
                                        <p class="p-0 m-0 font-monospace text-decoration-underline text-light">WhatsApp:</p>
                                        <p class="ps-2 m-0 font-monospace text-light">{{ $user->whatsapp }}</p>
                                    </div>
                                    <div class="p-0 m-0">
                                        <p class="p-0 m-0 font-monospace text-decoration-underline text-light">Address:</p>
                                        <p class="ps-2 m-0 font-monospace text-light">{{ $user->address }}</p>
                                    </div>
                                    <div class="p-0 m-0">
                                        <p class="p-0 m-0 font-monospace text-decoration-underline text-light">Gender:</p>
                                        <p class="ps-2 m-0 font-monospace text-light">{{ $user->gender }}</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

