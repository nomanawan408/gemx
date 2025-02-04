<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <!-- Additional CSS or JS as needed -->
    @yield('head')
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/assets/owl.theme.default.min.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            text-align: center;

        }

        .card-container {
            background: rgb(6, 93, 21);
            background-image: linear-gradient(0deg, rgba(0, 68, 11, 0.85) 0%, rgba(0, 0, 0, 0.85) 100%), url("{{ url('assets/img/pass-bg.jpg') }}");
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
            margin-top: 22px;
            line-height: 58px;
        }

        .info p {
            line-height: 34px;
        }

        .user_name {
            font-size: 30px;
            font-weight: 560;
            margin-top: 10px;
        }

        .business_name {
            font-size: 22px;
            font-style: italic;
            font-weight: 500;
            margin-top: 16px;
        }
        .overlay {
            width: 100%;
            height: 100%;
            /* height: 100%; */
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <div class="main-panel">
            @include('layouts.header')

            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div> 
                            <h3 class="fw-bold mb-3">Entry Pass</h3>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            <button id="downloadButton" class="btn btn-info btn-round me-2">Download Entry Pass</button>
                            {{-- <a href="#" class="btn btn-primary btn-round">Add Buyers</a> --}}
                          </div>
                    </div>
                    <div class="card-container" id="entry-pass">
                        <div class="overlay d-flex flex-column align-items-center justify-content-around">
                            <div class="d-flex w-100 justify-content-between align-items-center">
                                <img src="{{ asset('assets/img/gemx-logo1.png') }}" width="90px" alt="">
                                <img src="{{ asset('assets/img/gemx-logo2.png') }}" width="90px" alt="">
                            </div>
                           <div>
                            <span class="p-0 m-0" style="font-size: 20px">ID: 0{{ $user->id }}</span>
                            <div class="header p-0 m-0 ">
                                {{ strtoupper($user->roles->first()->name == 'international_visitor' ? 'VISITOR' : $user->roles->first()->name) }}
                            </div>
                            <div class="info p-0 m-0">
                                <p class="user_name p-0 m-0">{{ strtoupper($user->name) }}</p>
                                <p class="business_name m-0 p-0">{{ strtoupper($user->business->company_name) }}</p>
                            </div>
                           </div>
                            {{-- {!! QrCode::size(100)->generate($user->id) !!} --}}
                          <div class="m-2 d-flex align-items-center justify-content-center" style="background: white ; padding: 16px;border-radius: 6px">
                           
                           {{$qrCode}}

                          </div>
                        </div>
                    </div>
                </div>
            </div>
           
            @include('layouts.footer')

        </div>

        <!-- End Custom template -->
    </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    {{-- <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script> --}}

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>

    <script src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/maps/jquery-jvectormap-world-mill.js"></script>

    <script>
        window.onload = function() {
            document.getElementById("downloadButton")
                .addEventListener("click", () => {
                    const invoice = this.document.getElementById("entry-pass");
                    console.log(invoice);
                    console.log(window);
                    var opt = {
                        margin: .5,
                        filename: 'Entry-pass.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 1
                        },
                        html2canvas: {
                            scale: 1
                        },
                        jsPDF: {
                            unit: 'in',
                            format: 'a4',
                            orientation: 'landscape'
                        }
                    };
                    html2pdf().from(invoice).set(opt).save();
                })
        }
    </script>
    <!-- Bootstrap JS -->
    @yield('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
