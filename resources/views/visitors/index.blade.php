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
                          <div class="table-responsive " style="font-size: 10px !important;">
                            <table
                              id="multi-filter-select"
                              class="display table table-striped table-hover"
                            >
                            <thead > 
                              <tr>
                                  <th>Name</th>
                                  <th>Profession</th>
                                  <th>Address</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>CNIC No</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Name</th>
                                  <th>Profession</th>
                                  <th>Address</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              @foreach($visitors as $visitor)
                              <tr>
                                  <td>{{ $visitor->name }}</td>
                                  <td>{{ $visitor->profession }}</td>
                                  <td>{{ $visitor->address }}</td>
                                  <td>{{ $visitor->email }}</td>
                                  <td>{{ $visitor->phone }}</td>
                                  <td>{{ $visitor->cnic_passport_no }}</td>
                                  <td>
                                    <td>
                                      @if($visitor->status == 'pending')
                                          <div>
                                              <form action="{{ route('users.approve', $visitor->id) }}" method="POST" style="display:inline;">
                                                  @csrf
                                                  <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                              </form>
                                              <form action="{{ route('users.reject', $visitor->id) }}" method="POST" style="display:inline;">
                                                  @csrf
                                                  <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                              </form>
                                          </div>                                  
                                      @else
                                          <span class="badge bg-{{ $visitor->status == 'approved' ? 'success' : 'danger' }}">{{ ucfirst($visitor->status) }}</span>
                                      @endif
                                    </td>       
                                  
                                  <td>
                                    <button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#visitorModal{{ $visitor->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                              </tr>
                              <!-- Modal for visitor {{ $visitor->id }} -->
                              <div class="modal fade" id="visitorModal{{ $visitor->id }}" tabindex="-1" aria-labelledby="visitorModalLabel{{ $visitor->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="visitorModalLabel{{ $visitor->id }}">Visitor Details</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="row">
                                            <h3>Personal Details</h3>
                                            <p><strong>Name:</strong> {{ $visitor->name }}</p>
                                            <p><strong>Profession:</strong> {{ $visitor->profession }}</p>
                                            <p><strong>Address:</strong> {{ $visitor->address }}</p>
                                          </div>
                                          <div class="row">
                                            <h3>Bussiness Details</h3>
                                            <p><strong>Business Name:</strong> {{ $visitor->business_name }}</p>
                                            <p><strong>Business Type:</strong> {{ $visitor->business_type }}</p>
                                            <p><strong>Business Address:</strong> {{ $visitor->business_address }}</p>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <p><strong>Email:</strong> {{ $visitor->email }}</p>
                                          <p><strong>Phone:</strong> {{ $visitor->phone }}</p>
                                          <p><strong>CNIC/Passport No:</strong> {{ $visitor->cnic_passport_no }}</p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>                              
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