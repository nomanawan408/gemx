@extends('layouts.app')

@section('content')
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Buyers</h3>
                {{-- <h6 class="op-7 mb-2">All visitors are here</h6> --}}

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
                      <th>Passport No.</th>
                      <th>Phone </th>
                      <th>Flight arrival date & time </th>
                      <th>Pickup Terminal </th>
                      <th>Drop off Terminal </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Country</th>
                      <th>Passport No.</th>
                      <th>Phone</th>
                      <th>Flight arrival date & time</th>
                      <th>Pickup Terminal</th>
                      <th>Drop off Terminal</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($flights as $flight)
                    <tr>
                      <td>{{ $flight->user->name }}</td>
                      <td>{{ $flight->user->country }}</td>
                      <td>{{ $flight->user->cnic_passport_no }}</td>
                      <td>{{ $flight->user->phone }}</td>
                      <td>{{ $flight->arrival_date_time }}</td>
                      <td>{{ $flight->pickup_terminal }}</td>
                      <td>{{ $flight->dropoff_terminal }}</td>
                    </tr>
                    @endforeach
                  </tbody>                          </table>
                  </div>
                  </div>
                </div>
                </div>
            </div>
          </div>
        </div>
@endsection 