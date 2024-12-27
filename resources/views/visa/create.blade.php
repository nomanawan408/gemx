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
    <h4 class="card-title">Upload Visa</h4>
  </div>
  <div class="card-body">
    <form action="{{ route('visa.upload') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="visaFile" class="form-label">Visa File</label>
        <input type="file" class="form-control" id="visaFile" name="visaFile" required>
      </div>
      <button type="submit" class="btn btn-primary">Upload</button>
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