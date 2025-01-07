@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Accommodations</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Buyer Name</th>
                                        <th>Hotel Name</th>
                                        <th>Room No</th>
                                        <th>Check-in Time</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accommodations as $accommodation)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2">
                                                        @if($accommodation->user->attachment && $accommodation->user->attachment->personal_photo)
                                                            <img src="{{ asset('storage/'.$accommodation->user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40">
                                                        @else
                                                            <div class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($accommodation->user->name, 0, 1)) }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0 text-sm">{{ $accommodation->user->name }}</h6>
                                                        <small class="text-muted">{{ $accommodation->user->email }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td>{{ $accommodation->hotel_name }}</td>
                                            <td>{{ $accommodation->room_no }}</td>
                                            <td>{{ $accommodation->check_in_time }}</td>
                                            <td>{{ $accommodation->description }}</td>
                                            <td>
                                                <a href="{{ route('accommodation.edit', $accommodation->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('accommodation.destroy', $accommodation->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                            
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