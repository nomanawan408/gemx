@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Profile</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ url()->previous() }}" class="btn btn-label-info btn-round me-2">Go Back</a>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Picture Section -->
                        <div class="col-md-3 bg-dark pt-4 text-light" style="border-radius: 10px">
                            <div class="w-100 text-center">
                                @if ($user->attachment && $user->attachment->personal_photo)
                                    <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}"
                                        style="height: 200px;width:200px;border-radius: 10px" alt="Profile Picture"
                                        class="img-fluid rounded-circle mb-3 border border-3 border-primary">
                                @else
                                    <div class="d-flex justify-content-center align-items-center rounded-circle bg-primary"
                                        style="height: 200px; width: 200px;">
                                        <span class="h1 text-white mb-0">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                                <h3 class="text-center pt-3 fw-bold text-light">{{ strtoupper($user->name) }}</h3>
                            </div>
                            <hr>

                            <div class="p-0 m-0">
                                <p class="p-0 m-0 font-monospace text-decoration-underline">Email:</p>
                                <p class="ps-2 m-0 font-monospace">{{ $user->email ?? '-' }}</p>
                            </div>
                            <div class="p-0 m-0">
                                <p class="p-0 m-0 font-monospace text-decoration-underline">Phone:</p>
                                <p class="ps-2 m-0 font-monospace">{{ $user->phone ?? '-' }}</p>
                            </div>
                            <div class="p-0 m-0">
                                <p class="p-0 m-0 font-monospace text-decoration-underline">Mobile:</p>
                                <p class="ps-2 m-0 font-monospace">{{ $user->mobile ?? '-' }}</p>
                            </div>
                            <div class="p-0 m-0">
                                <p class="p-0 m-0 font-monospace text-decoration-underline">WhatsApp:</p>
                                <p class="ps-2 m-0 font-monospace">{{ $user->whatsapp ?? '-' }}</p>
                            </div>
                            <div class="p-0 m-0">
                                <p class="p-0 m-0 font-monospace text-decoration-underline">Address:</p>
                                <p class="ps-2 m-0 font-monospace">{{ $user->address ?? '-' }}</p>
                            </div>
                            <div class="p-0 m-0">
                                <p class="p-0 m-0 font-monospace text-decoration-underline">Gender:</p>
                                <p class="ps-2 m-0 font-monospace">{{ $user->gender ?? '-' }}</p>
                            </div>
                            @if (!$user->hasRole('buyer'))
                                <div class="p-0 m-0">
                                    <p class="p-0 m-0 font-monospace text-decoration-underline">Profession:</p>
                                    <p class="ps-2 m-0 font-monospace">{{ $user->profession }}</p>
                                </div>
                            @endif
                            <hr>
                        </div>

                        <!-- Tabbed Profile Information Section -->
                        <div class="col-md-9 pt-3">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" id="profileTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic"
                                        type="button" role="tab" aria-controls="basic" aria-selected="true">
                                        <i class="fas fa-user-circle me-1"></i> Basic Information
                                    </button>
                                </li>
                                @if ($user->business && $user->business->company_name != null)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="business-tab" data-bs-toggle="tab" data-bs-target="#business"
                                        type="button" role="tab" aria-controls="business" aria-selected="false">
                                        <i class="fas fa-building me-1"></i> Business Details
                                    </button>
                                </li>
                                @endif
                                @if ($user->hasRole('exhibitor'))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="exhibitor-tab" data-bs-toggle="tab" data-bs-target="#exhibitor"
                                        type="button" role="tab" aria-controls="exhibitor" aria-selected="false">
                                        <i class="fas fa-store me-1"></i> Exhibitor Details
                                    </button>
                                </li>
                                @endif
                                @if ($user->hasRole('international_visitor'))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="international-tab" data-bs-toggle="tab" data-bs-target="#international"
                                        type="button" role="tab" aria-controls="international" aria-selected="false">
                                        <i class="fas fa-globe me-1"></i> International Details
                                    </button>
                                </li>
                                @endif
                                @if ($user->hasRole('visitor'))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="visitor-tab" data-bs-toggle="tab" data-bs-target="#visitor"
                                        type="button" role="tab" aria-controls="visitor" aria-selected="false">
                                        <i class="fas fa-user-tag me-1"></i> Visitor Details
                                    </button>
                                </li>
                                @endif
                                @if ($user->hasRole('buyer'))
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="buyer-tab" data-bs-toggle="tab" data-bs-target="#buyer"
                                        type="button" role="tab" aria-controls="buyer" aria-selected="false">
                                        <i class="fas fa-shopping-cart me-1"></i> Buyer Details
                                    </button>
                                </li>
                                @endif
                            </ul>
                            
                            <!-- Tab content -->
                            <div class="tab-content pt-4" id="profileTabsContent">
                                <!-- Basic Information Tab -->
                                <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold mb-3">Basic Information</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><strong>Father Name:</strong> <span>{{ $user->father_first_name }}
                                                        {{ $user->father_last_name }}</span></li>
                                                <li class="mb-2"><strong>Passport/CNIC No:</strong> {{ $user->cnic_passport_no ?? '-' }}</li>
                                                <li class="mb-2"><strong>Date of issue:</strong> {{ $user->date_of_issue ?? '-' }}</li>
                                                <li class="mb-2"><strong>Date of Expiry:</strong> {{ $user->date_of_expiry ?? '-' }}</li>
                                                @if ($user->hasRole('buyer') || $user->hasRole('international_visitor'))
                                                    <li class="mb-2"><strong>Any Previous Trips to Pakistan:</strong>
                                                        {{ $user->trip_to_pak == 0 ? 'No' : 'Yes' }}</li>
                                                    <li class="mb-2"><strong>Type of Passport:</strong>
                                                        {{ $user->passport_type ?? '-' }}</li>
                                                    <li class="mb-2"><strong>Product Interest:</strong>
                                                        {{ isset($user->business->product_interest) ? $user->business->product_interest : 'Not Set' }}</li>
                                                    <li class="mb-2"><strong>Expected Budget for PKGJS 2025:</strong>
                                                        {{ $user->business->amount ?? '-' }}</li>
                                                @endif
                                                <li class="mb-2"><strong>Country:</strong> {{ $user->country ?? '-' }}</li>
                                                <li class="mb-2"><strong>Nationality:</strong> {{ $user->nationality ?? '-' }}</li>
                                                <li class="mb-2"><strong>Which way you are invited:</strong>
                                                    {{ $user->invited_way ?? '-' }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Business Details Tab -->
                                @if ($user->business && $user->business->company_name != null)
                                <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold mb-3">Business Details</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><strong>Company Name:</strong> {{ $user->business->company_name }}</li>
                                                <li class="mb-2"><strong>Company Address:</strong> {{ $user->business->address }}</li>
                                                <li class="mb-2"><strong>Company Email:</strong> {{ $user->business->company_email }}</li>
                                                <li class="mb-2"><strong>Position:</strong> {{ $user->business->position }}</li>
                                                <li class="mb-2"><strong>Company Phone:</strong> {{ $user->business->company_phone }}</li>
                                                @if (!$user->hasRole('exhibitor'))
                                                    <li class="mb-2"><strong>Company Mobile:</strong> {{ $user->business->company_mobile }}</li>
                                                @endif
                                                <li class="mb-2"><strong>Website URL:</strong> 
                                                    <a href="{{ $user->business->website_url }}" target="_blank">{{ $user->business->website_url }}</a>
                                                </li>
                                                <li class="mb-2"><strong>Main Import Countries:</strong> {{ $user->business->main_import_countries }}</li>
                                                <li class="mb-2"><strong>Main Export Countries:</strong> {{ $user->business->main_export_countries }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Exhibitor Details Tab -->
                                @if ($user->hasRole('exhibitor'))
                                <div class="tab-pane fade" id="exhibitor" role="tabpanel" aria-labelledby="exhibitor-tab">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold mb-3">Exhibitor Specific Details</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><strong>Chamber/Association Membership:</strong> {{ $user->business->chamber_association_member }}</li>
                                                <li class="mb-2"><strong>Nature of Business:</strong> {{ $user->business->nature_of_business }}</li>
                                                <li class="mb-2"><strong>Type of Business:</strong> {{ $user->business->type_of_business }}</li>
                                                <li class="mb-2"><strong>Main Export Items:</strong> {{ $user->business->main_export_items }}</li>
                                                <li class="mb-2"><strong>Business Registered:</strong> {{ $user->business->company_registered_number }}</li>
                                                <li class="mb-2"><strong>NTN:</strong> {{ $user->business->ntn }}</li>
                                                <li class="mb-2"><strong>GST:</strong> {{ $user->business->gst }}</li>
                                                <li class="mb-2"><strong>Chamber/Association Membership No:</strong> {{ $user->business->chamber_association_no }}</li>
                                                <li class="mb-2"><strong>Annual Turnover (PKR):</strong> {{ $user->business->annual_turnover }}</li>
                                                <li class="mb-2"><strong>Annual Export (USD):</strong> {{ $user->business->annual_import_export }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- International Visitor Tab -->
                                @if ($user->hasRole('international_visitor'))
                                <div class="tab-pane fade" id="international" role="tabpanel" aria-labelledby="international-tab">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold mb-3">International Visitor Details</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><strong>Type of Business:</strong> {{ $user->business->type_of_business }}</li>
                                                <li class="mb-2"><strong>Main Business Items:</strong> {{ $user->business->main_business_items }}</li>
                                                <li class="mb-2"><strong>Main Import Items:</strong> {{ $user->business->main_import_items }}</li>
                                                <li class="mb-2"><strong>Annual Turnover (USD):</strong> {{ $user->business->annual_turnover }}</li>
                                                <li class="mb-2"><strong>Annual Import/Export (USD):</strong> {{ $user->business->annual_import_export }}</li>
                                                <li class="mb-2"><strong>Annual Import from Pakistan (USD):</strong> {{ $user->business->annual_import_from_pak }}</li>
                                                <li class="mb-2"><strong>Company Tax Number:</strong> {{ $user->business->vat_tax_number }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Visitor Tab -->
                                @if ($user->hasRole('visitor'))
                                <div class="tab-pane fade" id="visitor" role="tabpanel" aria-labelledby="visitor-tab">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold mb-3">Visitor Details</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><strong>Main Export Items:</strong> {{ $user->business->main_export_items }}</li>
                                                <li class="mb-2"><strong>Annual Turnover (PKR):</strong> {{ $user->business->annual_turnover }}</li>
                                                <li class="mb-2"><strong>Annual National Sales (PKR):</strong> {{ $user->business->national_sale }}</li>
                                                <li class="mb-2"><strong>Annual Export (USD):</strong> {{ number_format($user->business->annual_import_export, 2) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Buyer Tab -->
                                @if ($user->hasRole('buyer'))
                                <div class="tab-pane fade" id="buyer" role="tabpanel" aria-labelledby="buyer-tab">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="fw-bold mb-3">Buyer Details</h5>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><strong>Company Registration No:</strong> {{ $user->business->company_registered_number }}</li>
                                                <li class="mb-2"><strong>Company VAT/TAX No:</strong> {{ $user->business->vat_tax_number }}</li>
                                                <li class="mb-2"><strong>Chamber/Association Membership Number:</strong> {{ $user->business->chamber_association_no }}</li>
                                                <li class="mb-2"><strong>Type of Business:</strong> {{ $user->business->type_of_business }}</li>
                                                <li class="mb-2"><strong>Main Business Items:</strong> {{ $user->business->main_business_items }}</li>
                                                <li class="mb-2"><strong>Main Import Items:</strong> {{ $user->business->main_import_items }}</li>
                                                <li class="mb-2"><strong>Annual Turnover (USD):</strong> {{ $user->business->annual_turnover }}</li>
                                                <li class="mb-2"><strong>Annual Import (USD):</strong> {{ number_format($user->business->annual_import_export, 2) }}</li>
                                                <li class="mb-2"><strong>Annual Import From Pakistan (USD):</strong> {{ number_format($user->business->annual_import_from_pak, 2) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                        </div>
                                    @endif



                                </div>

                                <div class="col-md-6">
                                    @if (isset($user->participant))
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="fw-bold">Participants Details</h5>

                                                <ul class="list-unstyled small">
                                                    <li>
                                                        <strong>Participant Name:</strong>
                                                        {{ $user->participant->firstname }}
                                                        {{ $user->participant->lastname }}
                                                    </li>

                                                    <li>
                                                        <strong>Participant Father Name:</strong>
                                                        {{ $user->participant->father_firstname }}
                                                        {{ $user->participant->father_lastname }}
                                                    </li>

                                                    <li>
                                                        <strong>Gender:</strong> {{ $user->participant->gender }}
                                                    </li>
                                                    <li>
                                                        <strong>Phone:</strong> {{ $user->participant->phone }}
                                                    </li>
                                                    <li>
                                                        <strong>Mobile:</strong> {{ $user->participant->mobile }}
                                                    </li>
                                                    <li>
                                                        <strong>WhatsApp:</strong> {{ $user->participant->whatsapp }}
                                                    </li>
                                                    <li>
                                                        <strong>Email:</strong> {{ $user->participant->email }}
                                                    </li>
                                                    <li>
                                                        <strong>Facebook:</strong> {{ $user->participant->facebook }}
                                                    </li>
                                                    <li>
                                                        <strong>LinkedIn:</strong> {{ $user->participant->linkedin }}
                                                    </li>
                                                    <li>
                                                        <strong>Instagram:</strong> {{ $user->participant->instagram }}
                                                    </li>
                                                    <li>
                                                        <strong>Telegram:</strong> {{ $user->participant->telegram }}
                                                    </li>
                                                    <li>
                                                        <strong>WeChat:</strong> {{ $user->participant->wechat }}
                                                    </li>
                                                    <li>
                                                        <strong>IMO:</strong> {{ $user->participant->imo }}
                                                    </li>
                                                    <li>
                                                        <strong>Passport No:</strong> {{ $user->participant->passport_no }}
                                                    </li>
                                                    <li>
                                                        <strong>Passport Issue:</strong>
                                                        {{ \Carbon\Carbon::parse($user->participant->passport_issue)->format('d M, Y') }}
                                                    </li>
                                                    <li>
                                                        <strong>Passport Expiry:</strong>
                                                        {{ \Carbon\Carbon::parse($user->participant->passport_expiry)->format('d M, Y') }}
                                                    </li>
                                                    <li>
                                                        <strong>Passport Type:</strong>
                                                        {{ $user->participant->passport_type }}
                                                    </li>
                                                    <li>
                                                        <strong>Previous Trips to Pakistan:</strong>
                                                        {{ $user->participant->previous_trips }}
                                                    </li>
                                                    <li>
                                                        <strong>Upload Passport:</strong>
                                                        @if ($user->participant->passport_file)
                                                            <a href="{{ asset('storage/' . $user->participant->passport_file) }}"
                                                                target="_blank">View</a>
                                                        @else
                                                            Not Uploaded
                                                        @endif
                                                    </li>

                                                </ul>
                                            </div>
                                            <hr>
                                        </div>
                                    @endif

                                    <div class="row mb-4">
                                        @if ($user->hasRole('exhibitor'))
                                            <div class="col-md-12">
                                                <h5 class="fw-bold">Exhibitions Attended</h5>
                                                <ul class="list-unstyled small">
                                                    @if (isset($user->exhibition) && $user->exhibition->count() > 0)
                                                        <li>
                                                            <strong>Exhibition Name:</strong>
                                                            {{ $user->exhibition->exhibition_name }}
                                                        </li>
                                                        <li>
                                                            <strong>Exhibition Date:</strong>
                                                            {{ \Carbon\Carbon::parse($user->exhibition->exhibition_date) }}
                                                        </li>
                                                        <li>
                                                            <strong>Exhibition Type:</strong>
                                                            {{ $user->exhibition->type }}
                                                        </li>
                                                        <li>
                                                            <strong>Country:</strong>
                                                            {{ $user->exhibition->country }}
                                                        </li>
                                                    @else
                                                        <li>Not attended any exhibitions</li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endif

                                        {{-- Stall Information --}}
                                        @if (isset($user->stall))
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="fw-bold">Stall Information</h5>
                                                    <ul class="list-unstyled small">
                                                        <li><strong>Stall:</strong> {{ $user->stall->stall }}</li>
                                                        <li><strong>Stall Products:</strong>
                                                            {{ $user->stall->stall_products }}
                                                        </li>
                                                        {{-- <li><strong>Select Business:</strong> {{ $user->stall->selectbiz }} --}}
                                                        </li>
                                                        <li><strong>Booth Type:</strong> {{ $user->stall->booth_type }}
                                                        </li>
                                                        <li><strong>Booth Size:</strong> {{ $user->stall->booth_size == 'Any Special Request' ? $user->stall->other_booth_size : $user->stall->booth_size }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <hr>
                                            </div>
                                        @endif
                                        {{-- Social Media Information --}}

                                        <div class="col-md-12">
                                            <h5 class="fw-bold">Social Media</h5>
                                            <ul class="list-unstyled small">
                                                @if ($user->fb_url)
                                                    <li><strong>Facebook:</strong> <a
                                                            href="{{ $user->fb_url }}">{{ $user->fb_url }}</a></li>
                                                @endif
                                                @if ($user->linkedin)
                                                    <li><strong>Linkedin:</strong> <a
                                                            href="{{ $user->linkedin }}">{{ $user->linkedin }}</a></li>
                                                @endif
                                                @if ($user->telegram)
                                                    <li><strong>Telegram:</strong> <a
                                                            href="{{ $user->telegram }}">{{ $user->telegram }}</a></li>
                                                @endif
                                                @if ($user->instagram)
                                                    <li><strong>Instagram:</strong> <a
                                                            href="{{ $user->instagram }}">{{ $user->instagram }}</a></li>
                                                @endif
                                                @if ($user->wechat)
                                                    <li><strong>WeChat:</strong> <a
                                                            href="{{ $user->wechat }}">{{ $user->wechat }}</a></li>
                                                @endif
                                                @if ($user->imo)
                                                    <li><strong>IMO:</strong> <a
                                                            href="{{ $user->imo }}">{{ $user->imo }}</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                        <hr>
                                    </div>

                                    {{-- Attachments Information --}}

                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="fw-bold">Attachments</h5>
                                            <ul class="list-unstyled small">


                                                @if ($user->hasRole('visitor') || $user->hasRole('international_visitor'))
                                                    <li><strong>Personal Photo:</strong>
                                                        @if (isset($user->attachment->personal_photo))
                                                            <a href="{{ $user->attachment && $user->attachment->personal_photo ? asset('storage/' . $user->attachment->personal_photo) : asset('storage/uploads/photos/avatar.png') }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <strong>Passport/CNIC File:</strong>
                                                        @if (isset($user->attachment->passport_cnic_file))
                                                            <a href="{{ asset('storage/' . $user->attachment->passport_cnic_file) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    @if ($user->hasRole('international_visitor'))
                                                        <li><strong>Visa Upload:</strong>
                                                            @if (isset($user->visa))
                                                                <a href="{{ asset('storage/' . $user->visa->visa_file) }}"
                                                                    target="_blank" class="btn btn-primary btn-sm">View</a>
                                                            @else
                                                                Not uploaded
                                                            @endif
                                                        </li>
                                                    @endif

                                                @endif

                                                {{-- For Buyers --}}
                                                @if ($user->hasRole('buyer'))
                                                    <li>
                                                        <strong>Passport/CNIC File:</strong>
                                                        @if (isset($user->attachment->passport_cnic_file))
                                                            <a href="{{ asset('storage/' . $user->attachment->passport_cnic_file) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Personal Photo:</strong>
                                                        @if (isset($user->attachment->personal_photo))
                                                            <a href="{{ asset('storage/' . $user->attachment->personal_photo) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Company Catalogue:</strong>
                                                        @if (isset($user->attachment->company_catalogue))
                                                            <a href="{{ asset('storage/' . $user->attachment->company_catalogue) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Bank Statement:</strong>
                                                        @if (isset($user->attachment->bank_statement))
                                                            <a href="{{ asset('storage/' . $user->attachment->bank_statement) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Business Card:</strong>
                                                        @if (isset($user->attachment->business_card))
                                                            <a href="{{ asset('storage/' . $user->attachment->business_card) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Company Certificate:</strong>
                                                        @if (isset($user->attachment->company_certificate))
                                                            <a href="{{ asset('storage/' . $user->attachment->company_certificate) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Chamber Association Certificate:</strong>
                                                        @if (isset($user->attachment->chamber_association_certificate))
                                                            <a href="{{ asset('storage/' . $user->attachment->chamber_association_certificate) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    {{--  --}}
                                                    <li><strong>Visa Uplaod:</strong>
                                                        @if (isset($user->visa))
                                                            <a href="{{ asset('storage/' . $user->visa->visa_file) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                @endif

                                                {{-- For Exhibitors --}}
                                                @if ($user->hasRole('exhibitor'))
                                                    <li><strong>Bank Statement:</strong>
                                                        @if (isset($user->attachment->bank_statement))
                                                            <a href="{{ asset('storage/' . $user->attachment->bank_statement) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <strong>Passport/CNIC File:</strong>
                                                        @if (isset($user->attachment->passport_cnic_file))
                                                            <a href="{{ asset('storage/' . $user->attachment->passport_cnic_file) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Personal Photo:</strong>
                                                        @if (isset($user->attachment->personal_photo))
                                                            <a href="{{ asset('storage/' . $user->attachment->personal_photo) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Company Registration Number:</strong>
                                                        @if (isset($user->attachment->company_registration_number))
                                                            <a href="{{ asset('storage/' . $user->attachment->company_registration_number) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Company Logo:</strong>
                                                        @if (isset($user->attachment->company_logo))
                                                            <a href="{{ asset('storage/' . $user->attachment->company_logo) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>

                                                    <li><strong>Company Catalogue:</strong>
                                                        @if (isset($user->attachment->company_catalogue))
                                                            <a href="{{ asset('storage/' . $user->attachment->company_catalogue) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>

                                                    <li><strong>Business Card:</strong>
                                                        @if (isset($user->attachment->business_card))
                                                            <a href="{{ asset('storage/' . $user->attachment->business_card) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Chamber Association Certificate:</strong>
                                                        @if (isset($user->attachment->chamber_association_certificate))
                                                            <a href="{{ asset('storage/' . $user->attachment->chamber_association_certificate) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Pay Order Image:</strong>
                                                        @if (isset($user->attachment->pay_order_image))
                                                            <a href="{{ asset('storage/' . $user->attachment->pay_order_image) }}"
                                                                target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <strong>Pay Order Draft Number:</strong>
                                                        @if (isset($user->attachment->pay_order_draft_no))
                                                            {{ $user->attachment->pay_order_draft_no }}
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Pay Order Amount:</strong>
                                                        @if (isset($user->attachment->pay_order_amount))
                                                            {{ number_format($user->attachment->pay_order_amount, 2) }}
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Pay Order Date:</strong>
                                                        @if (isset($user->attachment->pay_order_date))
                                                            {{ $user->attachment->pay_order_date }}
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>
                                                    <li><strong>Pay Order Bank Name:</strong>
                                                        @if (isset($user->attachment->pay_order_bank_name))
                                                            {{ $user->attachment->pay_order_bank_name }}
                                                        @else
                                                            Not uploaded
                                                        @endif
                                                    </li>

                                                    <li><strong>Recommendation:</strong>
                                                        
                                                        @if (isset($user->attachment->recommendation))
                                                            {{ $user->attachment->recommendation }}
                                                        @else
                                                            Not Mentioned
                                                        @endif
                                                    </li>
                                                    {{--  --}}
                                                @endif
                                            </ul>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
