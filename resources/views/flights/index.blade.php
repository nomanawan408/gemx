@extends('layouts.app')

@section('content')
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
              @if(auth()->user()->hasRole('international_visitor'))
                @if(!auth()->user()->flight)
                  <h4 style="text-align: center; color: #d90000">
                    <strong>Please Provide us your flight details, so that we can facilitate you in terms of providing Transportation from Airport the Expo.</strong>
                  </h4>
                @endif
              @endif
                <h3 class="fw-bold mb-3">Fights Details</h3>
                {{-- <h6 class="op-7 mb-2">All visitors are here</h6> --}}
              </div> 
            
            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                  <div class="table-responsive">
                    <table
                    id="multi-filter-select"
                    class="display table table-striped table-hover"
                >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Flight Number</th>
                            <th>Airline Name</th>
                            <th>Number of Persons</th>
                            <th>Departure from your Country</th>
                            <th>Departure from Pakistan</th>
                            <th>Pickup Terminal</th>
                            <th>Dropoff Terminal</th>
                            <th>Ticket File</th>
                            @if (auth()->user()->hasRole('international_visitor'))
                              <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flights as $flight)
                        <tr>
                            <td>{{ $flight->user->name }}</td>
                            <td>{{ $flight->flight_no ?? 'N/A' }}</td>
                            <td>{{ $flight->airline_name ?? 'N/A' }}</td>
                            <td>{{ $flight->no_of_persons ?? 'N/A' }}</td>
                            <td>{{ $flight->departure_date_time ? \Carbon\Carbon::parse($flight->departure_date_time)->format('d-m-Y H:i A') : 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($flight->arrival_date_time)->format('d-m-Y H:i A') }}</td>
                            <td>{{ $flight->pickup_terminal }}</td>
                            <td>{{ $flight->dropoff_terminal }}</td>
                            <td>
                                @if($flight->ticket_upload)
                                    <a href="{{ asset('storage/'.$flight->ticket_upload) }}" target="_blank">View Ticket</a>
                                @else
                                    N/A
                                @endif
                            </td>
                           @if (auth()->user()->hasRole('international_visitor'))
                           <td>
                            <form action="{{ route('flight-details.destroy', $flight->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this flight?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            </td>
                           @endif
                            
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                  </div>
                  </div>
                </div>
                </div>
            </div>
          </div>
        </div>
@endsection 


