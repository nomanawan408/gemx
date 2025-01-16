@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <!-- Header Section -->
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Change Password</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ url()->previous() }}" class="btn btn-label-info btn-round me-2">Go Back</a>
                  </div>    
            </div>

            <!-- Visa Upload Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('auth.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#allusersTable').DataTable();
            $('#approvedusersTable').DataTable();
            $('#rejectedusersTable').DataTable();
        });
    </script>
@endsection

