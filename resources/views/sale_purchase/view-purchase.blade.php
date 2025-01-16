@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Purchases Document</h3>
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
                                        @if (auth()->user()->can('manage sale_purchase'))
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
                                        @if (auth()->user()->can('manage sale_purchase'))
                                            <td>
                                                <!-- Delete Sale/Purchase Document -->
                                                @if($user->attachment && $user->attachment->sale_purchase)
                                                    <form action="{{ route('sale-purchase.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this document?');" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                @endif
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
