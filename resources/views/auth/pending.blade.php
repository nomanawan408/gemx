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
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
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

    <!-- CSS Just for demo purpose, don't include it in your project -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" /> --}}
</head>
<body >
    <div class="pt-4 container text-center" >
        <h1>Account Pending Approval</h1>
        <p>Your account is currently under review. Please wait while we process your request.</p>
        <div class="pb-5">
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary mt-4">Go to Dashboard</a>
        </div>
    </div>

    @cannot('admin')
    <div style="width:100%; height: 350px; background-color: #f4f4f9; color: #333; line-height: 1.6; margin: 0; padding: 0;">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-1.jpg') }}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-2.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-3.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-4.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-5.jpg') }}" alt="Second slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

   

    <div class="container pt-5">
      <div class="row">
        <br/>
    </div>
    <div class="col text-center">
      <p>The Jewel of Pakistan’s
      </p>
      <h2 class="text-primary">The top show of 2025 for<br>Minerals,
        Fossils, Gemstones, & Jewelry!</h2>
      </div>


      <div class="row text-center">
            <div class="col">
            <div class="counter">
        <h2 style="font-style:bold !important" class=" font-weight-bold timer count-title count-number" data-to="150" data-speed="1500"></h2>
         <p class="count-text ">Exhibitors</p>
      </div>
            </div>
                <div class="col">
                 <div class="counter">
        <h2   style="font-style:bold !important" class=" font-weight-bold timer count-title count-number" data-to="50" data-speed="1500"></h2>
        <p class="count-text ">Countries</p>
      </div>
                </div>
                <div class="col">
                    <div class="counter">
        <h2  style="font-style:bold !important"  class="font-weight-bold timer count-title count-number" data-to="05" data-speed="1500"></h2>
        <p class="count-text ">Halls</p>
      </div></div>
                <div class="col">
                <div class="counter font-weight-bold ">
        <h2 class=" timer count-title count-number" data-to="10000" data-speed="1500"></h2>
        <p class="count-text ">Visitors</p>
      </div>
                </div>
           </div>
    </div>

      <div class="py-5">
      <div class="owl-carousel owl-theme">
        <div class="item" style="width:250px">
          <img src="{{ asset('assets/img/logos/1.png') }}" alt="">
        </div>
        <div class="item" style="width:250px">
          <img src="{{ asset('assets/img/logos/2.png') }}" alt="">
        </div>
        <div class="item" style="width:250px">
          <img src="{{ asset('assets/img/logos/3.png') }}" alt="">
        </div>
        <div class="item" style="width:250px">
          <img src="{{ asset('assets/img/logos/4.png') }}" alt="">
        </div>
        <div class="item" style="width:250px">
          <img src="{{ asset('assets/img/logos/5.png') }}" alt="">
        </div>
        <div class="item" style="width:250px">
          <img src="{{ asset('assets/img/logos/6.png') }}" alt="">
        </div>
        <div class="item" style="width:250px">
          <img src="{{ asset('assets/img/logos/7.png') }}" alt="">
        </div>

        
      </div>
      </div>


  @endcan
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
$("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
type: "line",
height: "70",
width: "100%",
lineWidth: "2",
lineColor: "#177dff",
fillColor: "rgba(23, 125, 255, 0.14)",
});

$("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
type: "line",
height: "70",
width: "100%",
lineWidth: "2",
lineColor: "#f3545d",
fillColor: "rgba(243, 84, 93, .14)",
});

$("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
type: "line",
height: "70",
width: "100%",
lineWidth: "2",
lineColor: "#ffa534",
fillColor: "rgba(255, 165, 52, .14)",
});
</script>
<!-- Bootstrap JS -->
@yield('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
<script>
$(document).ready(function () {
$("#basic-datatables").DataTable({});

$("#multi-filter-select").DataTable({
pageLength: 5,
initComplete: function () {
  this.api()
    .columns()
    .every(function () {
      var column = this;
      var select = $(
        '<select class="form-select"><option value=""></option></select>'
      )
        .appendTo($(column.footer()).empty())
        .on("change", function () {
          var val = $.fn.dataTable.util.escapeRegex($(this).val());

          column
            .search(val ? "^" + val + "$" : "", true, false)
            .draw();
        });

      column
        .data()
        .unique()
        .sort()
        .each(function (d, j) {
          select.append(
            '<option value="' + d + '">' + d + "</option>"
          );
        });
    });
},
});

// Add Row
$("#add-row").DataTable({
pageLength: 5,
});

var action =
'<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

$("#addRowButton").click(function () {
$("#add-row")
  .dataTable()
  .fnAddData([
    $("#addName").val(),
    $("#addPosition").val(),
    $("#addOffice").val(),
    action,
  ]);
$("#addRowModal").modal("hide");
});
});
</script>
</body>
</html>
