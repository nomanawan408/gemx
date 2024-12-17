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
                                  <th>Phone</th>
                                  <th>CNIC No</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          {{-- <tfoot>
                              <tr>
                                  <th>Name</th>
                                  <th>Profession</th>
                                  <th>Address</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot> --}}
                          <tbody>
                              @foreach($visitors as $visitor)
                              <tr>
                                  <td>
                                    <div class="d-flex align-items-center">
                                      <div class="avatar me-2">
                                        @if($visitor->attachment && $visitor->attachment->personal_photo)
                                          <img src="{{ asset('storage/' . $visitor->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40">
                                        @else
                                          <div class="avatar-initial rounded-circle bg-label-primary">{{ substr($visitor->name, 0, 1) }}</div>
                                        @endif
                                      </div>
                                      <div class="d-flex flex-column">
                                        <h6 class="mb-0 text-sm">{{ $visitor->name }}</h6>
                                        <small class="text-muted">{{ $visitor->email }}</small>
                                      </div>
                                    </div>
                                  </td>
                                  <td>{{ $visitor->profession }}</td>
                                  <td>{{ $visitor->address }}</td>
                                  <td>{{ $visitor->phone }}</td>
                                  <td>{{ $visitor->cnic_passport_no }}</td>
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
                                            <p><strong>Username:</strong> {{ $visitor->username }}</p>
                                            <p><strong>Name:</strong> {{ $visitor->first_name }} {{ $visitor->last_name }}</p>
                                            <p><strong>Father Name:</strong> {{ $visitor->father_first_name }} {{ $visitor->father_last_name }}</p>
                                            <p><strong>Gender:</strong> {{ $visitor->gender }}</p>
                                            <p><strong>Country:</strong> {{ $visitor->country }}</p>
                                            <p><strong>Nationality:</strong> {{ $visitor->nationality }}</p>
                                            <p><strong>Address:</strong> {{ $visitor->address }}</p>
                                            <p><strong>Profession:</strong> {{ $visitor->profession }}</p>
                                            <p><strong>Phone:</strong> {{ $visitor->phone }}</p>
                                            <p><strong>Mobile:</strong> {{ $visitor->mobile }}</p>
                                            <p><strong>WhatsApp:</strong> {{ $visitor->whatsapp }}</p>
                                            <p><strong>Facebook:</strong> {{ $visitor->fb_url }}</p>
                                            <p><strong>LinkedIn:</strong> {{ $visitor->linkedin }}</p>
                                            <p><strong>Telegram:</strong> {{ $visitor->telegram }}</p>
                                            <p><strong>Instagram:</strong> {{ $visitor->instagram }}</p>
                                            <p><strong>WeChat:</strong> {{ $visitor->wechat }}</p>
                                            <p><strong>IMO:</strong> {{ $visitor->imo }}</p>
                                            <p><strong>CNIC/Passport No:</strong> {{ $visitor->cnic_passport_no }}</p>
                                            <p><strong>Date of Issue:</strong> {{ $visitor->date_of_issue }}</p>
                                            <p><strong>Date of Expiry:</strong> {{ $visitor->date_of_expiry }}</p>
                                            <p><strong>Invited Way:</strong> {{ $visitor->invited_way }}</p>
                                          </div>
                                          <div class="row">
                                            
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="row">
                                            <h3>Business Details</h3>
                                            <p><strong>Company Name:</strong> {{ $visitor->business->company_name }}</p>
                                            <p><strong>Address:</strong> {{ $visitor->business->address }}</p>
                                            <p><strong>Company Phone:</strong> {{ $visitor->business->company_phone }}</p>
                                            <p><strong>Company Mobile:</strong> {{ $visitor->business->company_mobile }}</p>
                                            <p><strong>Business Phone:</strong> {{ $visitor->business->business_phone }}</p>
                                            <p><strong>Position:</strong> {{ $visitor->business->position }}</p>
                                            <p><strong>Website URL:</strong> {{ $visitor->business->website_url }}</p>
                                            <p><strong>Export Items:</strong> {{ $visitor->business->export_items }}</p>
                                            <p><strong>Main Import Countries:</strong> {{ $visitor->business->main_import_countries }}</p>
                                            <p><strong>Main Export Countries:</strong> {{ $visitor->business->main_export_countries }}</p>
                                            <p><strong>Annual Turnover:</strong> {{ $visitor->business->annual_turnover }}</p>
                                            <p><strong>National Sale:</strong> {{ $visitor->business->national_sale }}</p>
                                            <p><strong>Annual Import/Export:</strong> {{ $visitor->business->annual_import_export }}</p>
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