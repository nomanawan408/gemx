<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .card {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
        }
        .card-content {
            padding: 20px;
        }
        .card-content table {
            margin-top: 20px;
        }
        .card-content th, .card-content td {
            padding: 10px;
        }
        .card-content tr:nth-child(even) {
            background-color: #fafafa;
        }
        .card-content th {
            text-align: left;
        }
    </style>
</head>

<body class="grey lighten-4">
    <div class="container">
        <h3 class="center-align">Verification</h3>
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 center-align">
                                @if ($user->attachment && $user->attachment->personal_photo)
                                <img src="{{ asset('storage/' . $user->attachment->personal_photo) }}"
                                    style="height: 100px;width:100px;border-radius: 10px" alt="Profile Picture"
                                    class="img-fluid rounded-circle mb-3 border border-3 border-primary">
                            @else
                                <div class="d-flex justify-content-center align-items-center rounded-circle bg-primary"
                                    style="height: 100px; width: 100px;">
                                    <span class="h1 text-white mb-0">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            </div>
                        </div>
                        <table class="striped">
                            <tbody>
                                <tr>
                                    <th>Role</th>
                                    <td>{{ $role }}</td>
                                </tr>
                                <tr>
                                    <th>User ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>CNIC/Passport</th>
                                    <td>{{ $user->cnic_passport_no }}</td>
                                </tr>
                                <tr>
                                    <th>Company Name</th>
                                    <td>{{ $company_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>

