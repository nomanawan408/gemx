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
                                <th>Position</th>
                                <th>Company</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Annual Turnover (USD)</th>
                                <th>Business Items</th>
                                <th>Start Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Company</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Annual Turnover (USD)</th>
                                <th>Business Items</th>
                                <th>Start Date</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh Tech</td>
                                <td>Edinburgh</td>
                                <td>tiger.nixon@example.com</td>
                                <td>+44-1234-567890</td>
                                <td>$320,800</td>
                                <td>Software, Hardware</td>
                                <td>2011/04/25</td>
                                <td>
                                  <button class="btn btn-success btn-sm" onclick="approveBuyer(1)">
                                      <i class="fas fa-check"></i> Approve
                                  </button>
                                  <button class="btn btn-danger btn-sm" onclick="rejectBuyer(1)">
                                      <i class="fas fa-times"></i> Reject
                                  </button>
                              </td>
                                
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo Finance</td>
                                <td>Tokyo</td>
                                <td>garrett.winters@example.com</td>
                                <td>+81-9876-543210</td>
                                <td>$170,750</td>
                                <td>Accounting, Auditing</td>
                                <td>2011/07/25</td>
                                <td>
                                  <button class="btn btn-success btn-sm" onclick="approveBuyer(1)">
                                      <i class="fas fa-check"></i> Approve
                                  </button>
                                  <button class="btn btn-danger btn-sm" onclick="rejectBuyer(1)">
                                      <i class="fas fa-times"></i> Reject
                                  </button>
                              </td>
                            </tr>
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