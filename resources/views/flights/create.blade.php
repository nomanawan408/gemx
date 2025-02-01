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
                            <form action="{{ route('flight-details.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <!-- User Details -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" value="{{ $user->name }}" readonly class="form-control"
                                            id="name" name="name">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" class="form-control" readonly value="{{ $user->country }}"
                                            id="country" name="country">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="passport_no" class="form-label">Passport No.</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{ $user->cnic_passport_no }}" id="passport_no" name="passport_no">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" readonly id="phone" name="phone"
                                            value="{{ $user->phone }}">
                                    </div>
                                </div>

                                <!-- Flight Details -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="flight_no" class="form-label">Flight Number</label>
                                        <input type="text" class="form-control @error('flight_no') is-invalid @enderror"
                                            id="flight_no" name="flight_no" placeholder="Enter flight number">
                                        @error('flight_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="airline_name" class="form-label">Airline Name</label>
                                        <input type="text"
                                            class="form-control @error('airline_name') is-invalid @enderror"
                                            id="airline_name" name="airline_name" placeholder="Enter airline name">
                                        @error('airline_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- <div class="col-md-6 mb-3">
                                    <label for="seat_no" class="form-label">Seat Number</label>
                                    <input type="text" class="form-control @error('seat_no') is-invalid @enderror" id="seat_no" name="seat_no" placeholder="Enter seat number">
                                    @error('seat_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                    @if (!auth()->user()->hasRole('international_visitor'))
                                        <div class="col-md-6 mb-3">
                                            <label for="no_of_persons" class="form-label">Number of Persons</label>
                                            <input type="number"
                                                class="form-control @error('no_of_persons') is-invalid @enderror"
                                                id="no_of_persons" name="no_of_persons"
                                                placeholder="Enter number of persons">
                                            @error('no_of_persons')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif
                                    <!-- Ticket Upload -->
                                    @if (!auth()->user()->hasRole('international_visitor'))
                                        <div class="col-md-6 mb-3">
                                            <label for="ticket_upload" class="form-label">Upload Ticket</label>
                                            <input type="file"
                                                class="form-control @error('ticket_upload') is-invalid @enderror"
                                                id="ticket_upload" name="ticket_upload" accept=".jpeg, .png, .pdf">
                                            @error('ticket_upload')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="departure_date_time" class="form-label">Departure From Your
                                            Counrty</label>
                                        <input type="datetime-local"
                                            class="form-control @error('departure_date_time') is-invalid @enderror"
                                            id="departure_date_time" name="departure_date_time">
                                        @error('departure_date_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="arrival_date_time" class="form-label">Departure From Pakistan<span
                                                style="color: red;">*</span></label>
                                        <input type="datetime-local"
                                            class="form-control @error('arrival_date_time') is-invalid @enderror"
                                            id="arrival_date_time" name="arrival_date_time" required>
                                        @error('arrival_date_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pickup and Dropoff -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="pickup_terminal" class="form-label">Pickup Location<span
                                                style="color: red;">*</span></label>
                                        <textarea class="form-control @error('pickup_terminal') is-invalid @enderror" id="pickup_terminal"
                                            name="pickup_terminal" rows="1" readonly placeholder="Enter pickup terminal or location">Islamabad International Airport</textarea>
                                        @error('pickup_terminal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="dropoff_terminal" class="form-label">Dropoff Location<span
                                                style="color: red;">*</span></label>
                                        <textarea class="form-control @error('dropoff_terminal') is-invalid @enderror" id="dropoff_terminal"
                                            name="dropoff_terminal" rows="1" placeholder="Enter dropoff terminal or location" readonly required>Sarena Hotel</textarea>
                                        @error('dropoff_terminal')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- @if (isset($user->participant))
                                    <hr>
                                    <h3 class="fw-bold mb-3">Add Flight Details for User's Participant
                                        ({{ $user->participant->firstname }}
                                        {{ $user->participant->lastname }})
                                    </h3>

                                    <!-- Participants -->
                                    <div class="row">
                                        <input type="hidden" value="{{ $user->participant->user_id }}"
                                            class="form-control @error('participant_user_id') is-invalid @enderror"
                                            id="participant_user_id" name="participant_user_id" readonly>
                                        @error('participant_user_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <div class="col-md-6 mb-3">
                                            <label for="participant_full_name" class="form-label">Participant Full
                                                Name</label>
                                            <input type="text"
                                                value="{{ $user->participant->firstname }} {{ $user->participant->lastname }}"
                                                class="form-control @error('participant_full_name') is-invalid @enderror"
                                                id="participant_full_name" name="participant_full_name"
                                                placeholder="Enter name of participants" readonly>
                                            @error('participant_full_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="participant_passport_no" class="form-label">Participant Passport
                                                No.</label>
                                            <input type="text" value="{{ $user->participant->passport_no }}"
                                                class="form-control @error('participant_passport_no') is-invalid @enderror"
                                                id="participant_passport_no" name="participant_passport_no"
                                                placeholder="Enter passport number of participants" readonly>
                                            @error('participant_passport_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Flight Details -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="participant_flight_no" class="form-label">Participant Flight
                                                Number</label>
                                            <input type="text"
                                                class="form-control @error('participant_flight_no') is-invalid @enderror"
                                                id="participant_flight_no" name="participant_flight_no"
                                                placeholder="Enter flight number">
                                            @error('participant_flight_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="participant_airline_name" class="form-label">Participant Airline
                                                Name</label>
                                            <input type="text"
                                                class="form-control @error('participant_airline_name') is-invalid @enderror"
                                                id="participant_airline_name" name="participant_airline_name"
                                                placeholder="Enter airline name">
                                            @error('participant_airline_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if (!auth()->user()->hasRole('international_visitor'))
                                            <div class="col-md-6 mb-3">
                                                <label for="participant_no_of_persons" class="form-label">Participant
                                                    Number of Persons</label>
                                                <input type="number"
                                                    class="form-control @error('participant_no_of_persons') is-invalid @enderror"
                                                    id="participant_no_of_persons" name="participant_no_of_persons"
                                                    placeholder="Enter number of persons">
                                                @error('participant_no_of_persons')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif
                                        <!-- Ticket Upload -->
                                        @if (!auth()->user()->hasRole('international_visitor'))
                                            <div class="col-md-6 mb-3">
                                                <label for="participant_ticket_upload" class="form-label">Participant
                                                    Upload Ticket</label>
                                                <input type="file"
                                                    class="form-control @error('participant_ticket_upload') is-invalid @enderror"
                                                    id="participant_ticket_upload" name="participant_ticket_upload"
                                                    accept=".jpeg, .png, .pdf">
                                                @error('participant_ticket_upload')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="participant_departure_date_time" class="form-label">Participant
                                                Departure From Your
                                                Counrty</label>
                                            <input type="datetime-local"
                                                class="form-control @error('participant_departure_date_time') is-invalid @enderror"
                                                id="participant_departure_date_time"
                                                name="participant_departure_date_time">
                                            @error('participant_departure_date_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="participant_arrival_date_time" class="form-label">Participant
                                                Departure From Pakistan<span style="color: red;">*</span></label>
                                            <input type="datetime-local"
                                                class="form-control @error('participant_arrival_date_time') is-invalid @enderror"
                                                id="participant_arrival_date_time" name="participant_arrival_date_time"
                                                required>
                                            @error('participant_arrival_date_time')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Pickup and Dropoff -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="participant_pickup_terminal" class="form-label">Participant Pickup
                                                Location<span style="color: red;">*</span></label>
                                            <textarea class="form-control @error('participant_pickup_terminal') is-invalid @enderror"
                                                id="participant_pickup_terminal" name="participant_pickup_terminal" rows="1" readonly
                                                placeholder="Enter pickup terminal or location">Islamabad International Airport</textarea>
                                            @error('participant_pickup_terminal')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="participant_dropoff_terminal" class="form-label">Participant
                                                Dropoff Location<span style="color: red;">*</span></label>
                                            <textarea class="form-control @error('participant_dropoff_terminal') is-invalid @enderror"
                                                id="participant_dropoff_terminal" name="participant_dropoff_terminal" rows="1"
                                                placeholder="Enter dropoff terminal or location" readonly required>Sarena Hotel</textarea>
                                            @error('participant_dropoff_terminal')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif --}}
                                <!-- Submit Button -->
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Create Flight</button>
                                        <a href="{{ route('flight-details.index') }}"
                                            class="btn btn-secondary">Cancel</a>
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
