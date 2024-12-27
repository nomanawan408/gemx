@extends('layouts.app')

@section('content')
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Buyers Flight Details</h3>
                {{-- <h6 class="op-7 mb-2">All visitors are here</h6> --}}

              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                {{-- <a href="#" class="btn btn-primary btn-round">Add Buyers</a> --}}
              </div>
            </div>
  
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
                                  <th>Country</th>
                                  <th>Phone</th>
                                  <th>Flight Arrival Date & Time</th>
                                  <th>Pickup Terminal</th>
                                  <th>Drop off Terminal</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($flights as $flight)
                                  <tr>
                                    <td>
                                      <div class="d-flex align-items-center">
                                        <div class="avatar me-2">
                                          @if($flight->user->attachment && $flight->user->attachment->personal_photo)
                                            <img src="{{ asset($flight->user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40">
                                          @else
                                            <div class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($flight->user->name, 0, 1)) }}</div>
                                          @endif
                                        </div>
                                        <div class="d-flex flex-column">
                                          <h6 class="mb-0 text-sm">{{ $flight->user->name }}</h6>
                                          <small class="text-muted">{{ $flight->user->email }}</small>
                                        </div>
                                      </div>
                                      </td>
                                      <td>{{ $flight->user->country }}</td>
                                      <td>{{ $flight->user->phone }}</td>
                                      <td>{{ $flight->flight_arrival_date_time }}</td>
                                      <td>{{ $flight->pickup_terminal }}</td>
                                      <td>{{ $flight->dropoff_terminal }}</td>
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