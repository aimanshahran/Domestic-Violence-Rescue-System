@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/content-styles.css')}}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}" />
    <script>
        var base_url = '{{ url("/") }}';
    </script>
    <!-- Favicon -->
    @include('nav.favicon')
    <!-- Favicon -->
    <!-- navbar
    ================================================== -->
    @include('nav.navbar')
    <!-- navbar
================================================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
    <!-- CHAT BUTTON -->
    @user
        @include('nav.chat')
    @enduser
    <!-- CHAT BUTTON -->
    <div class="col mx-auto">
        <div class="card card-2">
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-11">
                            <h2>{!! __('statistics.dvStat') !!}</h2>
                        </div>
                        @admin_writer
                        <div class="col-sm align-items-right">
                            <a href="{{ route('statistic.show') }}" class="btn btn-dark" role="button" aria-pressed="true">{!! __('statistics.edit') !!}</a>
                        </div>
                        @endadmin_writer
                    </div>
                </div>
                <div class="container mx-auto">
                    <div class="row">
                        <div class="p-3 col-sm-3 d-flex align-items-center text-center">
                            {!! __('statistics.numberMY') !!}
                        </div>
                        <div class="col-sm">
                            <canvas id="myDV" style="width:100%;max-width:500px; max-height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="p-3 col-sm-3 d-flex align-items-center text-center">
                            {!! __('statistics.numberDVRS') !!}
                        </div>
                        <div class="col-sm">
                            <canvas id="dvrs" style="width:100%;max-width:500px; max-height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
                <p>*{!! __('statistics.source') !!}</p>

                <p>*{!! __('statistics.note') !!}</p>
            </div>
        </div>
        <!-- /.8 -->
    </div>
    <!-- /.row-->
    <script>
        var xValues = {!!json_encode($year)!!};
        var yValues = {!!json_encode($data)!!};
        var barColors = "#004bad";

        new Chart("myDV", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                }
            }

        });
    </script>
    <script>
        var xValues = {!!json_encode($DVyear)!!};
        var yValues = {!!json_encode($DVdata)!!};
        var barColors = "#004bad";

        new Chart("dvrs", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                }
            }

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection



