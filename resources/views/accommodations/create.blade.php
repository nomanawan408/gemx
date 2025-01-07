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
                        <form action="{{ route('accommodation.store') }}" method="POST">
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
                                    <input type="text" readonly value="{{ $user->cnic_passport_no }}" class="form-control" id="passport_no" name="passport_no" required>
                                </div>

                                <!-- Hotel Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="hotel_name" class="form-label">Hotel Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="hotel_name" name="hotel_name" required>
                                </div>
                                <!-- Room Number -->
                                <div class="col-md-6 mb-3">
                                    <label for="room_no" class="form-label">Room Number<span style="color: red;">*</span></label>
                                    <input type="number" class="form-control" id="room_no" name="room_no" required>
                                </div>
                            </div>
                        
                            <div class="row">
                                
                                <!-- Check-in Time -->
                                <div class="col-md-6 mb-3">
                                    <label for="check_in_time" class="form-label">Check-in Time</label>
                                    <input type="time" class="form-control" id="check_in_time" name="check_in_time">
                                </div>
                                <!-- Accommodation Pass -->
                                <div class="col-md-6 mb-3">
                                    <label for="accommodation_pass" class="form-label">Accommodation Pass</label>
                                    <input type="file" class="form-control" id="accommodation_pass" name="accommodation_pass">
                                </div>
                            </div>
                        
                            <div class="row">
                                
                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"></textarea>
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