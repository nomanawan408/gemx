@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Add Accommodation Details</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('accommodation.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            
                            <div class="row">
                                <!-- Full Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" value="{{ $user->name }}" readonly class="form-control" id="name" name="name">
                                </div>

                                <!-- Passport Number -->
                                <div class="col-md-6 mb-3">
                                    <label for="passport_no" class="form-label">Passport Number<span style="color: red;">*</span></label>
                                    <input type="text" readonly value="{{ $user->cnic_passport_no }}" class="form-control @error('passport_no') is-invalid @enderror" id="passport_no" name="passport_no" required>
                                    @error('passport_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Hotel Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="hotel_name" class="form-label">Hotel Name<span style="color: red;">*</span></label>
                                    <select class="form-select @error('hotel_name') is-invalid @enderror" id="hotel_name" name="hotel_name" required>
                                        <option value="" selected disabled>- Select Hotel -</option>
                                        <option value="Serena Hotel">Serena Hotel</option>
                                        <option value="Best Western Hotel">Best Western Hotel</option>
                                        <option value="Marriott Hotel">Marriott Hotel</option>
                                        <option value="Ramada Hotel">Ramada Hotel</option>
                                    </select>
                                    @error('hotel_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Room Number -->
                                <div class="col-md-6 mb-3">
                                    <label for="room_no" class="form-label">Room Number<span style="color: red;">*</span></label>
                                    <input type="number" class="form-control @error('room_no') is-invalid @enderror" id="room_no" name="room_no" required>
                                    @error('room_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row">
                                
                                <!-- Check-in Time -->
                                <div class="col-md-6 mb-3">
                                    <label for="check_in_time" class="form-label">Check-in Date & Time </label>
                                    <input type="datetime-local" class="form-control @error('check_in_time') is-invalid @enderror" id="check_in_time" name="check_in_time">
                                    @error('check_in_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Accommodation Pass -->
                                <div class="col-md-6 mb-3">
                                    <label for="accommodation_pass" class="form-label">Booking Voucher</label>
                                    <input type="file" class="form-control @error('accommodation_pass') is-invalid @enderror" id="accommodation_pass" name="accommodation_pass">
                                    @error('accommodation_pass')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row">
                                
                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <div class="row">
                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Accommodation</button>
                                    <a href="{{ route('accommodation.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection