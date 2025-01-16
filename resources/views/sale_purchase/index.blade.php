@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Sale/Purchase Documents</h3>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Sale/Purchase Document</th>
                                        @if (auth()->user()->can('admin'))
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <a href="{{ route('profile.index', $user->id) }}">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $user->cnic_passport_no }}</td>
                                        <td>
                                            @if($user->attachment && $user->attachment->sale_purchase)
                                                <a href="{{ asset('storage/'.$user->attachment->sale_purchase) }}" target="_blank">View Document</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        @if (auth()->user()->can('admin'))
                                            <td>
                                                <!-- Upload Sale/Purchase Document -->
                                                <form action="{{ route('users.sale-purchase.upload', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="file" name="sale_purchase" class="form-control form-control-sm" required>
                                                        <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                                    </div>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
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
