@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <!-- Profile Picture Section -->
                    <div class="col-md-3 text-center bg-dark pt-4 text-light">
                        <img src="{{ asset('storage/'.$user->attachment->personal_photo) }}" style="height: 200px;width:200px" alt="Profile Picture" class="img-fluid rounded-circle mb-3 border border-3 border-primary">
                        <h3 class="fw-bold text-light">{{ $user->name }}</h3>
                        <p class="text-light">{{ $user->getRoleNames()->first()}}</p>
                        
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
                               
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5 class="fw-bold">Skills</h5>
                                        <ul class="list-unstyled small">
                                            <li>Interactive UI/UX Design</li>
                                            <li>Creative Graphic Design</li>
                                            <li>Web Development</li>
                                        </ul>
                                    </div>
                                </div>
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
