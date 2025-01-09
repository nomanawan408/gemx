@extends('layouts.app')

@section('content')
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">International Visitors Flight Details</h3>
                {{-- <h6 class="op-7 mb-2">All visitors are here</h6> --}}

              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('visitors.export.csv') }}" class="btn btn-label-info btn-round me-2">Export CSV</a>
                {{-- <a href="#" class="btn btn-primary btn-round">Add Buyers</a> --}}
              </div>

            </div>
  
            <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <!-- Tabs Navigation -->
                          <ul class="nav nav-tabs" id="visitorTabs" role="tablist">
                              <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="today-tab" data-bs-toggle="tab" data-bs-target="#today" type="button" role="tab" aria-controls="today" aria-selected="false">Today</button>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="this-week-tab" data-bs-toggle="tab" data-bs-target="#this-week" type="button" role="tab" aria-controls="this-week" aria-selected="false">This Week</button>
                              </li>
                          </ul>
          
                          <!-- Tabs Content -->
                          <div class="tab-content" id="visitorTabsContent">
                              <!-- All Tab -->
                              <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                  @include('partials.flights_view_table', ['flights' => $flights])
                              </div>
          
                              <!-- Today Tab -->
                              <div class="tab-pane fade" id="today" role="tabpanel" aria-labelledby="today-tab">
                                  @include('partials.flights_view_table', ['flights' => $todayFlights])
                              </div>
          
                              <!-- This Week Tab -->
                              <div class="tab-pane fade" id="this-week" role="tabpanel" aria-labelledby="this-week-tab">
                                  @include('partials.flights_view_table', ['flights' => $thisWeekFlights])
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          
          </div>
        </div>
@endsection 