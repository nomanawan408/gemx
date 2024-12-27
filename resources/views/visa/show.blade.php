@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Header Section -->
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Visa Details</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                {{-- <a href="{{ route('visa.edit', $visa->id) }}" class="btn btn-label-info btn-round me-2">Edit</a> --}}
                <a href="{{ route('visa.index') }}" class="btn btn-label-secondary btn-round">Back to List</a>
            </div>
        </div>

        <!-- Visa File Card -->
        <div class="card mb-4">
            <div class="card-header">
            <h4 class="card-title">Visa File</h4>
            </div>
            <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Visa File</label>
                <p> 
                    <img src="{{ asset('storage/' . $visa->visa_file) }}" alt="Visa Image" style="width: 100px; height: auto;">
                </p>
            </div>
            </div>
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