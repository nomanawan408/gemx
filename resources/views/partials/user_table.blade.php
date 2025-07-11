<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive" style="font-size: 10px !important;">
            <table id="{{ $tableId }}" class="display table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Profession</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Passport/CNIC</th>
                        @can('admin')
                            <th>Status</th>
                        @endcan
                        <th>Date/Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <!-- Name Column with Avatar -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2">
                                        @if ($user->attachment && $user->attachment->personal_photo)
                                            {{-- <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40"> --}}
                                            <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}"
                                                alt="Profile" class="rounded-circle" width="40" height="40">
                                        @else
                                            <div style="background-color: {{ '#' . str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT) }}; width: 40px; height: 40px;"
                                                class="avatar-initial rounded-circle d-flex align-items-center justify-content-center">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}</div>
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
                            @can('can approve')
                                <td>
                                    @if ($user->status == 'pending')
                                        {{-- <div>
                                            <form action="{{ route('users.approve', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                            <form action="{{ route('users.reject', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        </div> --}}
                                         <span class="badge bg-warning">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-{{ $user->status == 'approved' ? 'success' : 'danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    @endif
                                </td>
                                @endcan
                            @can('view status')
                                <td>
                                    <span class="badge bg-{{ $user->status == 'approved' ? 'success' : 'danger' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                            @endcan

                            <!-- Date/Time -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}
                                    </span>
                                    <span>{{ \Carbon\Carbon::parse($user->created_at)->format('h:i A') }}</span>
                                </div>
                            <!-- Action -->
                            <td class="g-4">
                                @if (auth()->user()->can('manage sale_purchase'))
                                    <a class="p-2" title="Upload Sale/Purchase"
                                        href="{{ route('sale-purchase.create', $user->id) }}"
                                        class="btn btn-link btn-primary btn-lg">
                                        <i class="fa fa-upload"></i>
                                    </a>
                                @endif
                                @can('admin')
                                    <a title="View Details" class="p-2" href="{{ route('profile.index', $user->id) }}"
                                        class="btn btn-link btn-primary btn-lg">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
