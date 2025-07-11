@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-inner">
    <!-- Header Section -->
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Visitors </h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <a href="{{ url()->previous() }}" class="btn btn-label-info btn-round me-2">Go Back</a>
      </div>
    </div>
    @if(auth()->user()->hasRole('sale_purchase_admin'))
    <!-- Approved users Tab -->
    <div class="tab-pane fade show active" id="approved-users" role="tabpanel" aria-labelledby="approved-users-tab">
      @include('partials.user_table', ['users' => $users->where('status', 'approved'), 'tableId' => 'approvedusersTable'])
    </div>
    @else
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="userTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-users-tab" data-bs-toggle="tab" data-bs-target="#all-users" type="button" role="tab" aria-controls="all-users" aria-selected="true">All users</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="approved-users-tab" data-bs-toggle="tab" data-bs-target="#approved-users" type="button" role="tab" aria-controls="approved-users" aria-selected="false">Approved</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="rejected-users-tab" data-bs-toggle="tab" data-bs-target="#rejected-users" type="button" role="tab" aria-controls="rejected-users" aria-selected="false">Rejected</button>
      </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="userTabsContent">
      <!-- All users Tab -->
      <div class="tab-pane fade show active" id="all-users" role="tabpanel" aria-labelledby="all-users-tab">
        @include('partials.user_table', ['users' => $users, 'tableId' => 'allusersTable'])
      </div>

      <!-- Approved users Tab -->
      <div class="tab-pane fade" id="approved-users" role="tabpanel" aria-labelledby="approved-users-tab">
        @include('partials.user_table', ['users' => $users->where('status', 'approved'), 'tableId' => 'approvedusersTable'])
      </div>

      <!-- Rejected users Tab -->
      <div class="tab-pane fade" id="rejected-users" role="tabpanel" aria-labelledby="rejected-users-tab">
        @include('partials.user_table', ['users' => $users->where('status', 'rejected'), 'tableId' => 'rejectedusersTable'])
      </div>
    </div>
    @endif

    <!-- user Detail Modals -->
    @foreach($users as $user)
      @include('partials.user_modal', ['user' => $user])
    @endforeach
  </div>
</div>
@endsection

@section('scripts')
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      var sortColumn = @can('admin') 6 @else 5 @endcan;
      $('.datatable').DataTable({
        order: [[sortColumn, 'desc']]
      });
    });
  </script>
@endsection
