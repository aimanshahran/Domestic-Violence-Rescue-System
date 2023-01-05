@extends('layouts.header')

@section('content')
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/content-styles.css')}}">
    <!-- Favicon -->
    @include('nav.favicon')
    <!-- Favicon -->
    <!-- navbar
    ================================================== -->
    @include('nav.navbar')
    <!-- navbar
================================================== -->
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
    <div class="col mx-auto">
        <div class="card card-2">
            <div class="container rounded bg-white mt-5 mb-5">
                <h2>Manage Emergency</h2>
                <table id="emergencyDetails" class="table table-bordered table-striped table-hover" style="width:100%;border: none;">
                    <thead class="thead-purple">
                    @forelse($emergencies as $emergency)
                    <tr>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;font-weight: bold">Case ID</th>
                        <td>**{{$emergency->id}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;font-weight: bold">Report time</th>
                        <td>{{ date_format($emergency->created_at, "d/m/Y H:i") }}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;font-weight: bold">Status</th>
                        <td>{{ucfirst($emergency->name)}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:20%;text-align: center;vertical-align: middle;font-weight: bold">Remarks</th>
                        <td>{{$emergency->remarks ?? 'No remark as '.date_format(now(), "d-m-Y H:i:s")}}</td>
                    </tr>
                    </thead>
                    @empty
                        <td colspan="6" style="text-align: center">{{ 'No emergency as '.date_format(now(), "d-m-Y H:i:s") }}</td>
                    @endforelse
                </table>
                <p style="color: red">**This is the latest emergency case for your user ID. If the status doesn't change and
                    you are not in the safe situations, please directly call the nearest police station or call <a href="tel:999">999</a>.</p>
            </div>
        </div>
        <!-- /.8 -->
    </div>
    <!-- /.row-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    <script src="{{ URL::asset('js/exit.js') }}"></script>
    </body>
@endsection



