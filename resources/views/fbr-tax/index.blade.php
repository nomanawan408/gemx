@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-inner">
    <!-- Header Section -->
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">FBR Tax</h3>
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
