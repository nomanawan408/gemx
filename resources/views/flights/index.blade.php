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
                            <tr>
                                <td>John Smith</td>
                                <td>United States</td>
                                <td>P123456789</td>
                                <td>+1-555-123-4567</td>
                                <td>2024/02/15 14:30</td>
                                <td>Terminal 1</td>
                                <td>Terminal 3</td>
                            </tr>
                            <tr>
                                <td>Maria Garcia</td>
                                <td>Spain</td>
                                <td>XYZ987654</td>
                                <td>+34-666-789-012</td>
                                <td>2024/02/16 09:45</td>
                                <td>Terminal 2</td>
                                <td>Terminal 4</td>
                            </tr>
                        </tbody>                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
@endsection 