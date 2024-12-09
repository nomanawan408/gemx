@extends('layouts.app')

@section('content')
<div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Select Buyers</h3>
              </div>
            </div>
  
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{ route('flight-details.create') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="buyer_type" class="form-label">Buyer Type</label>
                                    <select class="form-select" id="buyer_type" name="buyer_type" >
                                        <option value="">Select Buyer Type</option>
                                        @foreach($buyers as $buyer)
                                            <option value="{{ $buyer->type }}">{{ ucfirst($buyer->type) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row individual-buyer">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $buyer->name ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $buyer->phone ?? '' }}">
                                </div>
                            </div>

                            <div class="row company-buyer" style="display: none;">
                                <div class="col-md-6 mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $buyer->company_name ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="company_registration" class="form-label">Registration Number</label>
                                    <input type="text" class="form-control" id="company_registration" name="company_registration" value="{{ $buyer->company_registration ?? '' }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="company_address" class="form-label">Company Address</label>
                                    <textarea class="form-control" id="company_address" name="company_address" rows="3">{{ $buyer->company_address ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_person" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $buyer->contact_person ?? '' }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_phone" class="form-label">Contact Phone</label>
                                    <input type="tel" class="form-control" id="contact_phone" name="contact_phone" value="{{ $buyer->contact_phone ?? '' }}">
                                </div>
                            </div>
                      <div class="card-body">
                          
                          <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"  value="{{ $buyer->email ?? '' }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Select Buyer</button>
                                    <a href="{{ route('flight-details.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
@endsection