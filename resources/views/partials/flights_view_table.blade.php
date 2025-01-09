<div class="table-responsive">
    <table id="multi-filter-select" class="display table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Flight Name</th>
                <th>Flight No</th>
                <th>Seat No</th>
                <th>Departute Time</th>
                <th>Arrival Time</th>
                <th>Ticket File</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flights as $flight)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar me-2">
                                @if($flight->user->attachment && $flight->user->attachment->personal_photo)
                                    <img src="{{ asset('storage/'.$flight->user->attachment->personal_photo) }}" alt="Profile" class="rounded-circle" width="40" height="40">
                                @else
                                    <div class="avatar-initial rounded-circle bg-label-primary">{{ strtoupper(substr($flight->user->name, 0, 1)) }}</div>
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="mb-0 text-sm">{{ $flight->user->name }}</h6>
                                <small class="text-muted">{{ $flight->user->email }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $flight->airline_name }}</td>
                    <td>{{ $flight->flight_no }}</td>
                    <td>{{ $flight->seat_no }}</td>
                    <td>{{ $flight->departure_date_time }}</td>
                    <td>{{ $flight->arrival_date_time }}</td>
                    <td>
                        @if($flight->ticket_upload)
                            <a href="{{ asset('storage/'.$flight->ticket_upload) }}" target="_blank">View Ticket</a>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .table {
        border-collapse: separate;
        border-spacing: 0 15px;
    }
    .table thead th {
        background-color: #343a40;
        color: white;
    }
    .table tbody tr {
        background-color: #f8f9fa;
        transition: background-color 0.3s;
    }
    .table tbody tr:hover {
        background-color: #e9ecef;
    }
    .avatar img {
        border: 2px solid #343a40;
    }
    .avatar-initial {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
        color: white;
    }
    .bg-label-primary {
        background-color: #007bff;
    }
</style>
