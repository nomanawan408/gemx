<!DOCTYPE html>
<html>
<head>

    <title>Entry Pass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'DejaVu Sans', sans-serif;
            text-align: center; 

        }
        .card-container {
            background: rgb(6,93,21);
            background-image: linear-gradient(0deg, rgba(0, 68, 11, 0.85) 0%, rgba(0,0,0,0.85) 100%), url("{{ public_path('assets/img/pass-bg.jpg') }}");
            background-position: top center;
            background-size: cover;
            max-width: 450px;
            height: 500px;
            margin: 0 auto; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 16px; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
            color: white;
        }
        .header {
            font-size: 54px; 
            font-weight: 900; 
            margin-top: 16px;
        }
        .info p{
            line-height: 32px;
        }
        .user_name{
            font-size: 30px; 
            font-weight: 560; 
            margin-top: 16px;
        }
        .business_name{
            font-size: 22px; 
            font-style: italic;
            font-weight: 500; 
            margin-top: 16px;
        }
        .qr-code {
            text-align: center;
            background: rgb(206, 206, 206);
            border-radius: 16px;
            width: 120px;
            height: 120px;
        }   
        .overlay{
            width: 100%;
            height: 100%;
        }
    </style>
    
</head>
<body>
    <div class="card-container">
        <div class="overlay d-flex flex-column align-items-center justify-content-around">
            <div class="d-flex w-100 justify-content-between align-items-center">
                {{-- <img src="{{ public_path('assets/img/gemx-logo1.png') }}" width="90px" alt=""> --}}
                {{-- <img src="{{ public_path('assets/img/gemx-logo2.png') }}" width="90px" alt="">     --}}
            </div>
            <span class="p-0 m-0">ID:02345</span>
            <div class="header p-0 m-0 ">EXHIIBITOR</div>
            <div class="info p-0 m-0">
                <p class="user_name p-0 m-0">Mr. Ali Khan</p>
                <p class="business_name m-0 p-0">GENIXSTACK</p>
            </div>
            {{-- <div class="qr-code"> --}}
                {{-- {!! QrCode::size(100)->generate($user->id) !!} --}}
            {{-- </div> --}}
        </div>
    </div>
</body>
</html>
