@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Add Flight Details</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('flight-details.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="passport_no" class="form-label">Passport No.</label>
                                    <input type="text" class="form-control" id="passport_no" name="passport_no" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="arrival_datetime" class="form-label">Flight Arrival Date & Time</label>
                                    <input type="datetime-local" class="form-control" id="arrival_datetime" name="arrival_datetime" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pickup_location" class="form-label">Pickup Location</label>
                                    <select class="form-select" id="pickup_location" name="pickup_location" required>
                                        <option value="">Select Location Type</option>
                                        <option value="airport">Airport Terminal</option>
                                        <option value="hotel">Hotel</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3 airport-pickup">
                                    <label for="pickup_terminal" class="form-label">Pickup Terminal</label>
                                    <select class="form-select" id="pickup_terminal" name="pickup_terminal">
                                        <option value="">Select Terminal</option>
                                        <option value="Terminal 1">Terminal 1</option>
                                        <option value="Terminal 2">Terminal 2</option>
                                        <option value="Terminal 3">Terminal 3</option>
                                        <option value="Terminal 4">Terminal 4</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3 hotel-pickup" style="display: none;">
                                    <label for="hotel_details" class="form-label">Hotel Details</label>
                                    <textarea class="form-control" id="hotel_details" name="hotel_details" rows="3" placeholder="Enter hotel name and address"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dropoff_terminal" class="form-label">Drop off Terminal</label>
                                    <select class="form-select" id="dropoff_terminal" name="dropoff_terminal" required>
                                        <option value="">Select Terminal</option>
                                        <option value="Terminal 1">Terminal 1</option>
                                        <option value="Terminal 2">Terminal 2</option>
                                        <option value="Terminal 3">Terminal 3</option>
                                        <option value="Terminal 4">Terminal 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Flight</button>
                                    <a href="{{ route('flight-details.index') }}" class="btn btn-secondary">Cancel</a>
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