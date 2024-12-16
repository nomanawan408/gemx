@extends('layouts.app')

@section('content')
<div class="container">
            <div class="page-inner">
              <div
                class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
              >
                <div>
                  <h3 class="fw-bold mb-3">Buyers</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                  <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
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
                                  <th>Email</th>
                                  <th>Company Name</th> 
                                  <th>Company Email</th> 
                                  <th>Type of Business</th> 
                                  <th>Phone</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          {{-- <tfoot>
                              <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Company Name</th> 
                                  <th>Company Email</th> 
                                  <th>Type of Business</th>
                                  <th>Phone</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot> --}}
                          <tbody>
                              @foreach($buyers as $buyer)
                              <tr>
                                  <td>{{ $buyer->name }}</td>
                                  <td>{{ $buyer->email }}</td>
                                  <td>{{ $buyer->business->company_name ?? 'N/A' }}</td>
                                  <td>{{ $buyer->business->company_email ?? 'N/A' }}</td>
                                  <td>{{ json_decode($buyer->business->type_of_business) }}</td>
                                  <td>{{ $buyer->phone }}</td>
                                  <td>
                                  @if($buyer->status == 'pending')
                                      <div>
                                          <form action="{{ route('users.approve', $buyer->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                          </form>
                                          <form action="{{ route('users.reject', $buyer->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                          </form>
                                      </div>                                  
                                  @else
                                      <span class="badge bg-{{ $buyer->status == 'approved' ? 'success' : 'danger' }}">{{ ucfirst($buyer->status) }}</span>
                                  @endif
                                </td>                                  
                                  <td>
                                    <button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#buyerModal{{ $buyer->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                              </tr>
                              <!-- Modal for buyer {{ $buyer->id }} -->
                              <div class="modal fade" id="buyerModal{{ $buyer->id }}" tabindex="-1" aria-labelledby="buyerModalLabel{{ $buyer->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="buyerModalLabel{{ $buyer->id }}">Buyer Details</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="row">
                                            <h3>Personal Details</h3>
                                            <p><strong>Name:</strong> {{ $buyer->name }}</p>
                                            <p><strong>Company Name:</strong> {{ $buyer->company_name }}</p>
                                            <p><strong>Address:</strong> {{ $buyer->address }}</p>
                                          </div>
                                          <div class="row">
                                            <h3>Company Details</h3>
                                            <p><strong>Company Type:</strong> {{ $buyer->company_type }}</p>
                                            <p><strong>Industry:</strong> {{ $buyer->industry }}</p>
                                            <p><strong>Company Address:</strong> {{ $buyer->company_address }}</p>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <p><strong>Email:</strong> {{ $buyer->email }}</p>
                                          <p><strong>Phone:</strong> {{ $buyer->phone }}</p>
                                          <p><strong>NTN Number:</strong> {{ $buyer->ntn_number }}</p>
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