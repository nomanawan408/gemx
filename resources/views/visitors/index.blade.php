@extends('layouts.app')

@section('content')
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Visitors</h3>
                {{-- <h6 class="op-7 mb-2">All visitors are here</h6> --}}
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                {{-- <a href="#" class="btn btn-primary btn-round">Add Visitors</a> --}}
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
                                <th>Profession</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Nationality</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Passport No</th>
                                <th>Type of Passport</th>
                                <th>Visited Exhibitions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Profession</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Nationality</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Passport No</th>
                                <th>Type of Passport</th>
                                <th>Visited Exhibitions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>Software Engineer</td>
                                <td>USA</td>
                                <td>San Francisco</td>
                                <td>American</td>
                                <td>john.doe@example.com</td>
                                <td>+1-555-234567</td>
                                <td>US123456789</td>
                                <td>Ordinary</td>
                                <td>CES 2023, WebSummit 2022</td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>Business Analyst</td>
                                <td>UK</td>
                                <td>London</td>
                                <td>British</td>
                                <td>jane.smith@example.com</td>
                                <td>+44-7788-123456</td>
                                <td>UK987654321</td>
                                <td>Official</td>
                                <td>Gartner Symposium 2023</td>
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