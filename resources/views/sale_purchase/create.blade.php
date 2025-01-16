@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <!-- Header Section -->
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">users</h3>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                </div>
            </div>

            <!-- Visa Upload Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">Upload Sale/Purchase</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('sale-purchase.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="mb-3">
                            <label for="sale_purchase" class="form-label">Sale/Purchase File</label>
                            <input type="file" class="form-control @error('sale_purchase') is-invalid @enderror" id="sale_purchase" name="sale_purchase" required>
                            @error('sale_purchase')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Upload</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
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

