@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <!-- Header Section -->
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Onspot User Registration</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ url()->previous() }}" class="btn btn-label-info btn-round me-2">Back</a>
                </div>
            </div>

            <!-- Onspot Entry Form -->
            <div class="card mb-4">

                <div class="card-body">
                    <form action="{{ route('onspot-entry.store') }}" method="POST">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}">
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}">
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="father_first_name" class="form-label">Father's First Name</label>
                                <input type="text" class="form-control @error('father_first_name') is-invalid @enderror" id="father_first_name" name="father_first_name" placeholder="Enter father's first name" value="{{ old('father_first_name') }}">
                                @error('father_first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="father_last_name" class="form-label">Father's Last Name</label>
                                <input type="text" class="form-control @error('father_last_name') is-invalid @enderror" id="father_last_name" name="father_last_name" placeholder="Enter father's last name" value="{{ old('father_last_name') }}">
                                @error('father_last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Preferred Not To Say" {{ old('gender') == 'Preferred Not To Say' ? 'selected' : '' }}>Preferred Not To Say</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="profession" class="form-label">Profession</label>
                                <input type="text" class="form-control @error('profession') is-invalid @enderror" id="profession" name="profession" placeholder="Enter profession" value="{{ old('profession') }}">
                                @error('profession')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Enter address" value="{{ old('address') }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" placeholder="Enter country" value="{{ old('country') }}">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Enter city" value="{{ old('city') }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" placeholder="Enter WhatsApp number" value="{{ old('whatsapp') }}">
                                @error('whatsapp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                         
                            <div class="col-md-6">
                                <label for="cnic_passport_no" class="form-label">CNIC/Passport No</label>
                                <input type="text" class="form-control @error('cnic_passport_no') is-invalid @enderror" id="cnic_passport_no" name="cnic_passport_no" placeholder="Enter CNIC/Passport No" value="{{ old('cnic_passport_no') }}">
                                @error('cnic_passport_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date_of_issue" class="form-label">Date of Issue</label>
                                <input type="date" class="form-control @error('date_of_issue') is-invalid @enderror" id="date_of_issue" name="date_of_issue" placeholder="Enter date of issue" value="{{ old('date_of_issue') }}">
                                @error('date_of_issue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_expiry" class="form-label">Date of Expiry</label>
                                <input type="date" class="form-control @error('date_of_expiry') is-invalid @enderror" id="date_of_expiry" name="date_of_expiry" placeholder="Enter date of expiry" value="{{ old('date_of_expiry') }}">
                                @error('date_of_expiry')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="user_type" class="form-label">User Type</label>
                                <select class="form-select @error('user_type') is-invalid @enderror" id="user_type" name="user_type">
                                    <option value="" selected disabled>Select User Type</option>
                                    <option value="visitor" {{ old('user_type') == 'visitor' ? 'selected' : '' }}>Local Visitor</option>
                                    <option value="international_visitor" {{ old('user_type') == 'international_visitor' ? 'selected' : '' }}>International Visitor</option>
                                </select>
                                @error('user_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6"></div>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-success">Submit</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
