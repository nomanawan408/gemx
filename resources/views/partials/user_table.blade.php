<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive" style="font-size: 10px !important;">
            <table id="multi-filter-select" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>CNIC No</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                {{-- <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot> --}}
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <!-- Name Column with Avatar -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2">
                                        @if($user->attachment && $user->attachment->personal_photo)
                                            {{-- <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40"> --}}
                                            <img src="{{ asset($user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40">
                                        @else
                                            <div class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <!-- Profession -->
                            <td>{{ $user->profession }}</td>

                            <!-- Address -->
                            <td>{{ $user->address }}</td>

                            <!-- Phone -->
                            <td>{{ $user->phone }}</td>

                            <!-- CNIC No -->
                            <td>{{ $user->cnic_passport_no }}</td>

                            <!-- Status -->
                            <td>
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
                            </td>                                  

                            <!-- Action -->
                            <td>
                                <button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>                          
            </table>
        </div>
    </div>
</div>
