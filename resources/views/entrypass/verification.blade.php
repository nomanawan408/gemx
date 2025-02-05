<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="bg-success text-white">
    <div class="container text-center py-5">
        <h1>Verification</h1>
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <p class="card-text">Role: {{ $role }}</p>
                <p class="card-text">User ID: {{ $user->id }}</p>
                <p class="card-text">Name: {{ $user->name }}</p>
                <p class="card-text">CNIC/Passport: {{ $user->cnic_passport_no }}</p>
                <p class="card-text">Company Name: {{ $company_name }}</p>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>

