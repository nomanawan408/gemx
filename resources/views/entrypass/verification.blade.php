<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body style="background: #046120 " class=" text-white">
    <div class="container text-center py-5">
        <h1>Verification</h1>
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <table class="table table-borderless text-white">
                    <tbody>
                        <tr>
                            <th scope="row">Role</th>
                            <td>{{ $role }}</td>
                        </tr>
                        <tr>
                            <th scope="row">User ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">CNIC/Passport</th>
                            <td>{{ $user->cnic_passport_no }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Company Name</th>
                            <td>{{ $company_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>

