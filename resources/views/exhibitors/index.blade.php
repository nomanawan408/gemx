@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-inner">
    <!-- Header Section -->
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Exhibitors List</h3>
      </div>
     
    </div>

    <!-- Tabs Navigation -->
   @can('admin')
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
   @endcan

    <!-- Tabs Content -->
    <div class="tab-content" id="userTabsContent">
      <!-- All users Tab -->
      @can('admin')
      <div class="tab-pane fade " id="all-users" role="tabpanel" aria-labelledby="all-users-tab">
        <div class="card mt-4">
          <div class="card-body">
              <div class="table-responsive" style="font-size: 10px !important;">
                  <table id="multi-filter-select" class="display table table-striped table-hover">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Profession</th>
                              <th>Products Display</th>
                              @can('admin')
                                <th>Status</th>
                                <th>Actions</th>
                              @endcan
                          </tr>
                      </thead>
                     
                      <tbody>
                          @foreach($users as $user)
                              <tr>
                                  <!-- Name Column with Avatar -->
                                  <td>
                                      <div class="d-flex align-items-center">
                                          <div class="avatar me-2">
                                              @if($user->attachment && $user->attachment->personal_photo)
                                                  {{-- <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40"> --}}
                                                  <img src="{{ asset('storage/'.$user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40">
                                              @else
                                                  <div class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                              @endif
                                          </div>
                                          <div class="d-flex flex-column">
                                              <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                              {{-- <small class="text-muted">{{ $user->email }}</small> --}}
                                          </div>
                                      </div>
                                  </td>
      
                                  <!-- Profession -->
                                  <td>{{ $user->profession }}</td>
                                  <td>{{ $user->business->stall_products ?? 'N/A' }}</td>
                                  
                                  <!-- Status -->
                                  <td>
                                    @can('can approve')
                                        @if($user->status == 'pending')
                                            <div>
                                                <form action="{{ route('users.approve', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form action="{{ route('users.reject', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </div>                                  
                                        @else
                                            <span class="badge bg-{{ $user->status == 'approved' ? 'success' : 'danger' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        @endif
                                    @endcan
                                    @can('view status')
                                        <span class="badge bg-{{ $user->status == 'approved' ? 'success' : 'danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    @endcan
                                </td>                                  
                                <!-- Action -->
                                <td>  
                                    <a href="{{ route('profile.index', $user->id) }}" class="btn btn-link btn-primary btn-lg">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
      
                                 
                              </tr>
                          @endforeach
                      </tbody>                          
                  </table>
              </div>
          </div>
      </div>
      @endcan
      </div>

      <!-- Approved users Tab -->
      <div class="tab-pane fade show active" id="approved-users" role="tabpanel" aria-labelledby="approved-users-tab">
        <div class="card mt-4">
          <div class="card-body">
              <div class="table-responsive" style="font-size: 10px !important;">
                  <table id="multi-filter-select" class="display table table-striped table-hover">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Profession</th>
                              <th>Products Display</th>
                              @can('admin')
                                <th>Status</th>
                                <th>Actions</th>
                              @endcan
                          </tr>
                      </thead>
                     
                      <tbody>
                          @foreach($users as $user)
                              <tr>
                                  <!-- Name Column with Avatar -->
                                  <td>
                                      <div class="d-flex align-items-center">
                                          <div class="avatar me-2">
                                              @if($user->attachment && $user->attachment->personal_photo)
                                                  {{-- <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40"> --}}
                                                  <img src="{{ asset('storage/'.$user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40">
                                              @else
                                                  <div class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                              @endif
                                          </div>
                                          <div class="d-flex flex-column">
                                              <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                              {{-- <small class="text-muted">{{ $user->email }}</small> --}}
                                          </div>
                                      </div>
                                  </td>
      
                                  <!-- Profession -->
                                  <td>{{ $user->profession }}</td>
                                  <td>{{ $user->business->stall_products ?? 'N/A' }}</td>
                                  <!-- Status -->
                            <td>
                              @can('can approve')
                                  @if($user->status == 'pending')
                                      <div>
                                          <form action="{{ route('users.approve', $user->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                          </form>
                                          <form action="{{ route('users.reject', $user->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                          </form>
                                      </div>                                  
                                  @else
                                      <span class="badge bg-{{ $user->status == 'approved' ? 'success' : 'danger' }}">
                                          {{ ucfirst($user->status) }}
                                      </span>
                                  @endif
                              @endcan
                              @can('view status')
                                  <span class="badge bg-{{ $user->status == 'approved' ? 'success' : 'danger' }}">
                                      {{ ucfirst($user->status) }}
                                  </span>
                              
                          </td>                                  
                          <!-- Action -->
                          <td>
                              <a href="{{ route('profile.index', $user->id) }}" class="btn btn-link btn-primary btn-lg">
                                  <i class="fa fa-eye"></i>
                              </a>
                          </td>
                          @endcan       
                              </tr>
                          @endforeach
                      </tbody>                          
                  </table>
              </div>
          </div>
      </div>
      
      </div>
    </div>

    @can('admin')
       <div class="tab-pane fade" id="rejected-users" role="tabpanel" aria-labelledby="rejected-users-tab">
        <div class="card mt-4">
          <div class="card-body">
              <div class="table-responsive" style="font-size: 10px !important;">
                  <table id="multi-filter-select" class="display table table-striped table-hover">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Profession</th>
                              <th>Products Display</th>
                              @can('admin')
                                <th>Status</th>
                                <th>Actions</th>
                              @endcan
                          </tr>
                      </thead>
                     
                      <tbody>
                          @foreach($users as $user)
                              <tr>
                                  <!-- Name Column with Avatar -->
                                  <td>
                                      <div class="d-flex align-items-center">
                                          <div class="avatar me-2">
                                              @if($user->attachment && $user->attachment->personal_photo)
                                                  {{-- <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40"> --}}
                                                  <img src="{{ asset('storage/'.$user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40">
                                              @else
                                                  <div class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                              @endif
                                          </div>
                                          <div class="d-flex flex-column">
                                              <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                              {{-- <small class="text-muted">{{ $user->email }}</small> --}}
                                          </div>
                                      </div>
                                  </td>
      
                                  <!-- Profession -->
                                  <td>{{ $user->profession }}</td>
                                  <td>{{ $user->business->stall_products ?? 'N/A' }}</td>
                                    <!-- Status -->
                                    <td>
                                    @can('can approve')
                                        @if($user->status == 'pending')
                                            <div>
                                                <form action="{{ route('users.approve', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form action="{{ route('users.reject', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </div>                                  
                                        @else
                                            <span class="badge bg-{{ $user->status == 'approved' ? 'success' : 'danger' }}">
                                                {{ ucfirst($user->status) }}
                                            </span>
                                        @endif
                                    @endcan
                                    @can('view status')
                                        <span class="badge bg-{{ $user->status == 'approved' ? 'success' : 'danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    @endcan
                                </td>                                  
                                <!-- Action -->
                                @can('admin')
                                <td>
                                    <a href="{{ route('profile.index', $user->id) }}" class="btn btn-link btn-primary btn-lg">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                @endcan        
                                                        
                              </tr>
                          @endforeach
                      </tbody>                          
                  </table>
              </div>
          </div>
      </div>
    @endcan
      <!-- Rejected users Tab -->
     
      
      </div>
      </div>
    </div>

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
      $('#allusersTable').DataTable();
      $('#approvedusersTable').DataTable();
      $('#rejectedusersTable').DataTable();
    });
  </script>
@endsection
