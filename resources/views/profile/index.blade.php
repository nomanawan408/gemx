@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <!-- Profile Picture Section -->
                    <div class="col-md-3 text-center bg-dark pt-4 text-light">
                        {{-- <img src="{{ asset('storage/'.$user->attachment->personal_photo) }}" style="height: 200px;width:200px" alt="Profile Picture" class="img-fluid rounded-circle mb-3 border border-3 border-primary"> --}}
                        <h3 class="fw-bold text-light">{{ $user->name }}</h3>
                        <p class="text-light">Username: {{ $user->getRoleNames()->first()}}</p>
                        <p class="text-light">User Role: {{ $user->username}}</p>
                        
                        <table>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        </table>

                        
                        </div>
                    <!-- Profile Information Section -->
                    <div class="col-md-9">
                        <div class="row pt-5">
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="fw-bold">Contact Information</h5>
                                        <ul class="list-unstyled small">
                                            <li><strong>Phone:</strong> {{ $user->phone }}</li>
                                            <li><strong>Email:</strong> {{ $user->email }}</li>
                                        </ul>
                                    </div>
                                </div>
                                @if($user->business && $user->business->company_name != null)
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="fw-bold">Business Details</h5>
                                        <ul class="list-unstyled small">
                                            <li><strong>Company Name:</strong> {{ $user->business->company_name }}</li>
                                            <li><strong>Address:</strong> {{ $user->business->address }}</li>
                                            <li><strong>Company Phone:</strong> {{ $user->business->company_phone }}</li>
                                            <li><strong>Company Mobile:</strong> {{ $user->business->company_mobile }}</li>
                                            <li><strong>Business Phone:</strong> {{ $user->business->business_phone }}</li>
                                            <li><strong>Position:</strong> {{ $user->business->position }}</li>
                                            <li><strong>Website URL:</strong> <a href="{{ $user->business->website_url }}" target="_blank">{{ $user->business->website_url }}</a></li>
                                            <li><strong>Export Items:</strong> {{ $user->business->export_items }}</li>
                                            <li><strong>Main Import Countries:</strong> {{ $user->business->main_import_countries }}</li>
                                            <li><strong>Main Export Countries:</strong> {{ $user->business->main_export_countries }}</li>
                                            <li><strong>Annual Turnover:</strong> {{ $user->business->annual_turnover }}</li>
                                            <li><strong>National Sale:</strong> {{ number_format($user->business->national_sale, 2) }}</li>
                                            <li><strong>Annual Import/Export:</strong> {{ $user->business->annual_import_export }}</li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                @if(isset($user->userParticipants) && $user->userParticipants->count() > 0)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="fw-bold">Participants Details</h5>
                                            <ul class="list-unstyled small">
                                                @foreach($user->userParticipants as $participant)
                                                    <li>
                                                        <strong>First Name:</strong> {{ $participant->firstname }}
                                                    </li>
                                                    <li>
                                                        <strong>Last Name:</strong> {{ $participant->lastname }}
                                                    </li>
                                                    <li>
                                                        <strong>Father First Name:</strong> {{ $participant->father_firstname }}
                                                    </li>
                                                    <li>
                                                        <strong>Father Last Name:</strong> {{ $participant->father_lastname }}
                                                    </li>
                                                    <li>
                                                        <strong>Gender:</strong> {{ $participant->gender }}
                                                    </li>
                                                    <li>
                                                        <strong>Phone:</strong> {{ $participant->phone }}
                                                    </li>
                                                    <li>
                                                        <strong>Mobile:</strong> {{ $participant->mobile }}
                                                    </li>
                                                    <li>
                                                        <strong>WhatsApp:</strong> {{ $participant->whatsapp }}
                                                    </li>
                                                    <li>
                                                        <strong>Email:</strong> {{ $participant->email }}
                                                    </li>
                                                    <li>
                                                        <strong>Facebook:</strong> {{ $participant->facebook }}
                                                    </li>
                                                    <li>
                                                        <strong>LinkedIn:</strong> {{ $participant->linkedin }}
                                                    </li>
                                                    <li>
                                                        <strong>Instagram:</strong> {{ $participant->instagram }}
                                                    </li>
                                                    <li>
                                                        <strong>Telegram:</strong> {{ $participant->telegram }}
                                                    </li>
                                                    <li>
                                                        <strong>WeChat:</strong> {{ $participant->wechat }}
                                                    </li>
                                                    <li>
                                                        <strong>IMO:</strong> {{ $participant->imo }}
                                                    </li>
                                                    <li>
                                                        <strong>Passport No:</strong> {{ $participant->passport_no }}
                                                    </li>
                                                    <li>
                                                        <strong>Passport Issue:</strong> {{ \Carbon\Carbon::parse($participant->passport_issue)->format('d M, Y') }}
                                                    </li>
                                                    <li>
                                                        <strong>Passport Expiry:</strong> {{ \Carbon\Carbon::parse($participant->passport_expiry)->format('d M, Y') }}
                                                    </li>
                                                    <li>
                                                        <strong>Passport Type:</strong> {{ $participant->passport_type }}
                                                    </li>
                                                    <li>
                                                        <strong>Previous Trips:</strong> {{ $participant->previous_trips }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                @if($user->stall)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="fw-bold">Stall Information</h5>
                                            <ul class="list-unstyled small">
                                                <li><strong>Stall:</strong> {{ $user->stall->stall }}</li>
                                                <li><strong>Stall Products:</strong> {{ $user->stall->stall_products }}</li>
                                                <li><strong>Select Business:</strong> {{ $user->stall->selectbiz }}</li>
                                                <li><strong>Booth Type:</strong> {{ $user->stall->booth_type }}</li>
                                                <li><strong>Booth Size:</strong> {{ $user->stall->booth_size }}</li>
                                                <li><strong>Other Booth Size:</strong> {{ $user->stall->other_booth_size }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            
                            <div class="col-md-6">
                               
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="fw-bold">Basic Information</h5>
                                        <ul class="list-unstyled small">
                                            <li><strong>Gender:</strong> Male</li>
                                            <li><strong>Birthday:</strong> June 15, 1992</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="fw-bold">Attachments</h5>
                                        <ul class="list-unstyled small">
                                            
                                            @if (auth()->user()->can('view visitor attachment') || auth()->user()->can('view international attachment'))
                                            <li><strong>Personal Photo:</strong> 
                                                @if($user->attachment->personal_photo)
                                                    <a href="{{ asset('storage/'.$user->attachment->personal_photo) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Passport/CNIC File:</strong> 
                                                @if($user->attachment->passport_cnic_file)
                                                    <a href="{{ asset('storage/'.$user->attachment->passport_cnic_file) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            @endif

                                            {{-- For Buyers --}}
                                            @if (auth()->user()->can('view buyer attachment') )
                                            <li>
                                                <strong>Passport/CNIC File:</strong> 
                                                @if($user->attachment->passport_cnic_file)
                                                    <a href="{{ asset('storage/'.$user->attachment->passport_cnic_file) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Personal Photo:</strong> 
                                                @if($user->attachment->personal_photo)
                                                    <a href="{{ asset('storage/'.$user->attachment->personal_photo) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Company Catalogue:</strong> 
                                                @if($user->attachment->company_catalogue)
                                                    <a href="{{ asset('storage/'.$user->attachment->company_catalogue) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Bank Statement:</strong> 
                                                @if($user->attachment->bank_statement)
                                                    <a href="{{ asset('storage/'.$user->attachment->bank_statement) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Business Card:</strong> 
                                                @if($user->attachment->business_card)
                                                    <a href="{{ asset('storage/'.$user->attachment->business_card) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Company Certificate:</strong> 
                                                @if($user->attachment->company_certificate)
                                                    <a href="{{ asset('storage/'.$user->attachment->company_certificate) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Chamber Association Certificate:</strong> 
                                                @if($user->attachment->chamber_association_certificate)
                                                    <a href="{{ asset('storage/'.$user->attachment->chamber_association_certificate) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            {{--  --}}
                                            @endif

                                            {{-- For Exhibitors --}}
                                            @if (auth()->user()->can('view exhibitor attachment') )
                                            <li><strong>Bank Statement:</strong> 
                                                @if($user->attachment->bank_statement)
                                                    <a href="{{ asset('storage/'.$user->attachment->bank_statement) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Passport/CNIC File:</strong> 
                                                @if($user->attachment->passport_cnic_file)
                                                    <a href="{{ asset('storage/'.$user->attachment->passport_cnic_file) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Personal Photo:</strong> 
                                                @if($user->attachment->personal_photo)
                                                    <a href="{{ asset('storage/'.$user->attachment->personal_photo) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Company Registration Number:</strong> 
                                                @if($user->attachment->company_registration_number)
                                                    {{ $user->attachment->company_registration_number }}
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Company Logo:</strong> 
                                                @if($user->attachment->company_logo)
                                                    <a href="{{ asset('storage/'.$user->attachment->company_logo) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>

                                            <li><strong>Company Catalogue:</strong> 
                                                @if($user->attachment->company_catalogue)
                                                    <a href="{{ asset('storage/'.$user->attachment->company_catalogue) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>

                                            <li><strong>Business Card:</strong> 
                                                @if($user->attachment->business_card)
                                                    <a href="{{ asset('storage/'.$user->attachment->business_card) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Chamber Association Certificate:</strong> 
                                                @if($user->attachment->chamber_association_certificate)
                                                    <a href="{{ asset('storage/'.$user->attachment->chamber_association_certificate) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Pay Order Image:</strong> 
                                                @if($user->attachment->pay_order_image)
                                                    <a href="{{ asset('storage/'.$user->attachment->pay_order_image) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li>
                                                <strong>Pay Order Draft Number:</strong> 
                                                @if($user->attachment->pay_order_draft_no)
                                                    {{ $user->attachment->pay_order_draft_no }}
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Pay Order Amount:</strong> 
                                                @if($user->attachment->pay_order_amount)
                                                    {{ number_format($user->attachment->pay_order_amount, 2) }}
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Pay Order Date:</strong> 
                                                @if($user->attachment->pay_order_date)
                                                    {{ $user->attachment->pay_order_date->format('d/m/Y') }}
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Pay Order Bank Name:</strong> 
                                                @if($user->attachment->pay_order_bank_name)
                                                    {{ $user->attachment->pay_order_bank_name }}
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                           
                                            <li><strong>Recommendation:</strong> 
                                                @if($user->attachment->recommendation)
                                                    <a href="{{ asset('storage/'.$user->attachment->recommendation) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            {{--  --}}
                                            @endif


                                            
{{--                                            
                                            <li><strong>Company Logo:</strong> 
                                                @if($user->attachment->company_logo)
                                                    <a href="{{ asset('storage/'.$user->attachment->company_logo) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Company Catalogue:</strong> 
                                                @if($user->attachment->company_catalogue)
                                                    <a href="{{ asset('storage/'.$user->attachment->company_catalogue) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Company Certificate:</strong> 
                                                @if($user->attachment->company_certificate)
                                                    <a href="{{ asset('storage/'.$user->attachment->company_certificate) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Chamber Association Certificate:</strong> 
                                                @if($user->attachment->chamber_association_certificate)
                                                    <a href="{{ asset('storage/'.$user->attachment->chamber_association_certificate) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Personal Photo:</strong> 
                                                @if($user->attachment->personal_photo)
                                                    <a href="{{ asset('storage/'.$user->attachment->personal_photo) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Passport/CNIC File:</strong> 
                                                @if($user->attachment->passport_cnic_file)
                                                    <a href="{{ asset('storage/'.$user->attachment->passport_cnic_file) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Bank Statement:</strong> 
                                                @if($user->attachment->bank_statement)
                                                    <a href="{{ asset('storage/'.$user->attachment->bank_statement) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                            <li><strong>Company Registration Number:</strong> 
                                                @if($user->attachment->company_registration_number)
                                                    {{ $user->attachment->company_registration_number }}
                                                @else
                                                    Not uploaded
                                                @endif
                                            </li>
                                             --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="fw-bold">Social Media</h5>
                                        <ul class="list-unstyled small">
                                            @if($user->whatsapp)
                                                <li><strong>Whatsapp:</strong> <a href="#">{{ $user->whatsapp }}</a></li>
                                            @endif
                                            @if($user->fb_url)
                                                <li><strong>Facebook:</strong> <a href="{{ $user->fb_url }}">{{ $user->fb_url }}</a></li>
                                            @endif
                                            @if($user->linkedin)
                                                <li><strong>Linkedin:</strong> <a href="{{ $user->linkedin }}">{{ $user->linkedin }}</a></li>
                                            @endif
                                            @if($user->telegram)
                                                <li><strong>Telegram:</strong> <a href="{{ $user->telegram }}">{{ $user->telegram }}</a></li>
                                            @endif
                                            @if($user->instagram)
                                                <li><strong>Instagram:</strong> <a href="{{ $user->instagram }}">{{ $user->instagram }}</a></li>
                                            @endif
                                            @if($user->wechat)
                                                <li><strong>WeChat:</strong> <a href="{{ $user->wechat }}">{{ $user->wechat }}</a></li>
                                            @endif
                                            @if($user->imo)
                                                <li><strong>IMO:</strong> <a href="{{ $user->imo }}">{{ $user->imo }}</a></li>
                                            @endif
                                        </ul>
                                    </div>
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
