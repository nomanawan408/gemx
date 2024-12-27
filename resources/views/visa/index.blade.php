@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-inner">
    <!-- Header Section -->
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Visa Listing</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <a href="{{ route('visa.create') }}" class="btn btn-label-info btn-round me-2">Add New Visa</a>
      </div>
    </div>

    <!-- Visa Listing Table -->
    <div class="card mb-4">
      <div class="card-header">
        <h4 class="card-title">All Users' Visa Information</h4>
      </div>
      <div class="card-body">
        <table id="visaTable" class="table table-striped">
          <thead>
            <tr>
              <th>User Name</th>
              <th>User Email</th>
              <th>Uplaod Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($visas as $visa)
              <tr>
                <td>{{ $visa->user->name }}</td>
                <td>{{ $visa->user->email }}</td>
                
                <td>{{ $visa->updated_at }}</td>
                <td>
                    <a href="{{ asset('storage/' . $visa->visa_file) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                  <form action="{{ route('visa.destroy', $visa->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this visa?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
@endsection

@section('scripts')
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#visaTable').DataTable();
    });
  </script>
@endsection