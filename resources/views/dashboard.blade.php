<html>

<head>
    <style>
        <head>.counter {
            background-color: #f5f5f5;
            padding: 20px 0;
            border-radius: 5px;
        }

        .count-title {
            font-size: 40px;
            font-weight: normal;
            margin-top: 10px;
            margin-bottom: 0;
            text-align: center;
        }

        .count-text {
            font-size: 13px;
            font-weight: normal;
            margin-top: 10px;
            margin-bottom: 0;
            text-align: center;
        }

        .fa-2x {
            margin: 0 auto;

            float: none;
            display: table;
            color: #FF5E00;
        }

        .owl-carousel {
            margin: 50px auto;
        }

        .owl-carousel .item {
            height: 120px;
        }

        .owl-carousel .item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>

</html>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner pb-0 mb-0">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                </div>
                {{-- <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
              </div> --}}
            </div>

            {{-- //////////////////////////////////////////////////////////////////////////// --}}

            <div class="row">
              @if (auth()->user()->hasRole('buyer_admin'))
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <a href="{{ route('buyers.index') }}" class="text-decoration-none">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Buyers</p>
                                            <h4 class="card-title">{{ count($buyer) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->hasRole('exhibitor_admin'))
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <a href="{{ route('exhibitors.index') }}" class="text-decoration-none">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-luggage-cart"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Exhibitors</p>
                                            <h4 class="card-title">{{ count($exhibitor) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->hasRole('visitor_admin'))
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <a href="{{ route('international-visitors.index') }}" class="text-decoration-none">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="far fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">International Visitors</p>
                                            <h4 class="card-title">{{ count($international_visitor) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                @if (auth()->user()->hasRole('visitor_admin'))
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <a href="{{ route('visitors.index') }}" class="text-decoration-none">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Visitors</p>
                                                <h4 class="card-title">{{ count($visitor) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- //////////////////////////////////////////////////////////////////////////// --}}

            @if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('hospitality'))
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <a href="{{ route('buyers.index') }}" class="text-decoration-none">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Buyers</p>
                                                <h4 class="card-title">{{ count($buyer) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <a href="{{ route('exhibitors.index') }}" class="text-decoration-none">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                                <i class="fas fa-luggage-cart"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Exhibitors</p>
                                                <h4 class="card-title">{{ count($exhibitor) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <a href="{{ route('international-visitors.index') }}" class="text-decoration-none">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">International Visitors</p>
                                                <h4 class="card-title">{{ count($international_visitor) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <a href="{{ route('visitors.index') }}" class="text-decoration-none">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Visitors</p>
                                                <h4 class="card-title">{{ count($visitor) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    {{-- <div class="col-md-8">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row">
                  <div class="card-title">User Statistics</div>
                  <div class="card-tools">
                    <a
                      href="#"
                      class="btn btn-label-success btn-round btn-sm me-2"
                    >
                      <span class="btn-label">
                        <i class="fa fa-pencil"></i>
                      </span>
                      Export
                    </a>
                    <a href="#" class="btn btn-label-info btn-round btn-sm">
                      <span class="btn-label">
                        <i class="fa fa-print"></i>
                      </span>
                      Print
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-container" style="min-height: 375px">
                  <canvas id="statisticsChart"></canvas>
                </div>
                <div id="myChartLegend"></div>
              </div>
            </div>
          </div> --}}
                    {{-- <div class="col-md-4">
            <div class="card card-primary card-round">
              <div class="card-header">
                <div class="card-head-row">
                  <div class="card-title">Daily Sales</div>
                  <div class="card-tools">
                    <div class="dropdown">
                      <button
                        class="btn btn-sm btn-label-light dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        Export
                      </button>
                      <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                      >
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-category">March 25 - April 02</div>
              </div>
              <div class="card-body pb-0">
                <div class="mb-4 mt-2">
                  <h1>$4,578.58</h1>
                </div>
                <div class="pull-in">
                  <canvas id="dailySalesChart"></canvas>
                </div>
              </div>
            </div>
            <div class="card card-round">
              <div class="card-body pb-0">
                <div class="h1 fw-bold float-end text-primary">+5%</div>
                <h2 class="mb-2">17</h2>
                <p class="text-muted">Users online</p>
                <div class="pull-in sparkline-fix">
                  <div id="lineChart"></div>
                </div>
              </div>
            </div>
          </div> --}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-round">
                            <div class="card-header">
                                <div class="card-head-row card-tools-still-right">
                                    <h4 class="card-title">Users Geolocation</h4>
                                    <div class="card-tools">
                                        <button class="btn btn-icon btn-link btn-primary btn-xs">
                                            <span class="fa fa-angle-down"></span>
                                        </button>
                                        <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card">
                                            <span class="fa fa-sync-alt"></span>
                                        </button>
                                        <button class="btn btn-icon btn-link btn-primary btn-xs">
                                            <span class="fa fa-times"></span>
                                        </button>
                                    </div>
                                </div>
                                <p class="card-category">
                                    Distribution of users grouped by country
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="table-responsive table-hover table-sales">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Country</th>
                                                        <th>Users Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($usersByCountry as $data)
                                                        <tr>
                                                            <td>
                                                                <div class="flag">
                                                                    {{-- <img 
                                                            src="https://flagcdn.com/w40/{{ strtolower($data->country) }}.png" 
                                                            alt="{{ $data->country }}" 
                                                            width="40"
                                                        /> --}}
                                                                    {{ $data->country }}
                                                            </td>
                                                            <td class="text-end">{{ $data->count }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="card-body">
                                            <div class="card-head-row card-tools-still-right">
                                                <div class="card-title">New Customers</div>
                                                <div class="card-tools">
                                                    <div class="dropdown">
                                                        <button class="btn btn-icon btn-clean me-0" type="button"
                                                            id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <a class="dropdown-item" href="#">Another action</a>
                                                            <a class="dropdown-item" href="#">Something else
                                                                here</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-list py-4">
                                                @foreach ($recentUsers as $user)
                                                    <div class="item-list">
                                                        {{-- <div class="avatar">
                                      <img
                                        src="{{ asset('storage/'.$user->attachment->personal_photo ?? "") }}"
                                        alt="{{ $user->name }}"
                                        class="avatar-img rounded-circle"
                                      />
                                    </div> --}}
                                                        <div class="info-user ms-3">
                                                            <div class="username">{{ $user->name }}</div>
                                                            <div class="status">{{ $user->role }}</div>
                                                        </div>
                                                        <a href="{{ route('profile.index', $user->id) }}"
                                                            class="btn btn-icon btn-link op-8 me-1">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        {{-- <button class="btn btn-icon btn-link btn-danger op-8">
                                      <i class="fas fa-ban"></i>
                                    </button> --}}
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        {{-- MAPS --}}
                                        {{-- <div class="col-md-6">
                            <div class="mapcontainer">
                                <div id="world-map" class="w-100" style="height: 300px"></div>
                            </div>
                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">

                        </div>

                    </div>
            @endif

            {{-- ----------------||| ---------------- --}}

            @if (
                !auth()->user()->can('admin') ||
                    auth()->user()->hasRole('buyer_admin') ||
                    auth()->user()->hasRole('exhibitor_admin') ||
                    auth()->user()->hasRole('visitor_admin') ||
                    auth()->user()->hasRole('sale_purchase_admin'))
                <div
                    style="with:100%; height: 350px; background-color: #f4f4f9; color: #333; line-height: 1.6; margin: 0; padding: 0;">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-1.jpg') }}"
                                    alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-2.jpg') }}"
                                    alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-3.jpg') }}"
                                    alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-4.jpg') }}"
                                    alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('assets/img/slides/slide-5.jpg') }}"
                                    alt="Second slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>



                <div class="container pt-5">
                    <div class="row">
                        <br />
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
                                <h2 style="font-style:bold !important"
                                    class=" font-weight-bold timer count-title count-number" data-to="150"
                                    data-speed="1500"></h2>
                                <p class="count-text ">Exhibitors</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="counter">
                                <h2 style="font-style:bold !important"
                                    class=" font-weight-bold timer count-title count-number" data-to="50"
                                    data-speed="1500"></h2>
                                <p class="count-text ">Countries</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="counter">
                                <h2 style="font-style:bold !important"
                                    class="font-weight-bold timer count-title count-number" data-to="05"
                                    data-speed="1500"></h2>
                                <p class="count-text ">Halls</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="counter ">
                                <h2 class=" timer count-title count-number" data-to="10000" data-speed="1500"></h2>
                                <p class="count-text ">Visitors</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="">
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
            @endif


        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        (function($) {
            $.fn.countTo = function(options) {
                options = options || {};

                return $(this).each(function() {
                    // set options for current element
                    var settings = $.extend({}, $.fn.countTo.defaults, {
                        from: $(this).data('from'),
                        to: $(this).data('to'),
                        speed: $(this).data('speed'),
                        refreshInterval: $(this).data('refresh-interval'),
                        decimals: $(this).data('decimals')
                    }, options);

                    // how many times to update the value, and how much to increment the value on each update
                    var loops = Math.ceil(settings.speed / settings.refreshInterval),
                        increment = (settings.to - settings.from) / loops;

                    // references & variables that will change with each update
                    var self = this,
                        $self = $(this),
                        loopCount = 0,
                        value = settings.from,
                        data = $self.data('countTo') || {};

                    $self.data('countTo', data);

                    // if an existing interval can be found, clear it first
                    if (data.interval) {
                        clearInterval(data.interval);
                    }
                    data.interval = setInterval(updateTimer, settings.refreshInterval);

                    // initialize the element with the starting value
                    render(value);

                    function updateTimer() {
                        value += increment;
                        loopCount++;

                        render(value);

                        if (typeof(settings.onUpdate) == 'function') {
                            settings.onUpdate.call(self, value);
                        }

                        if (loopCount >= loops) {
                            // remove the interval
                            $self.removeData('countTo');
                            clearInterval(data.interval);
                            value = settings.to;

                            if (typeof(settings.onComplete) == 'function') {
                                settings.onComplete.call(self, value);
                            }
                        }
                    }

                    function render(value) {
                        var formattedValue = settings.formatter.call(self, value, settings);
                        $self.html(formattedValue);
                    }
                });
            };

            $.fn.countTo.defaults = {
                from: 0, // the number the element should start at
                to: 0, // the number the element should end at
                speed: 1000, // how long it should take to count between the target numbers
                refreshInterval: 100, // how often the element should be updated
                decimals: 0, // the number of decimal places to show
                formatter: formatter, // handler for formatting the value before rendering
                onUpdate: null, // callback method for every time the element is updated
                onComplete: null // callback method for when the element finishes updating
            };

            function formatter(value, settings) {
                return value.toFixed(settings.decimals);
            }
        }(jQuery));

        jQuery(function($) {
            // custom formatting example
            $('.count-number').data('countToOptions', {
                formatter: function(value, options) {
                    return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                }
            });

            // start all the timers
            $('.timer').each(count);

            function count(options) {
                var $this = $(this);
                options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                $this.countTo(options);
            }


            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            })

        });
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                margin: 10,
                loop: true,
                autoWidth: true,
                items: 4
            })
        })
    </script>

@endsection
