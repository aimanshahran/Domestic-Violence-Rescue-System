@extends('layouts.header')

@section('content')
    <script src="https://kit.fontawesome.com/9dc0cd5b8c.js" crossorigin="anonymous"></script>
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
                <h2><a href="{{ route('statistic.show') }}" style="color: black"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>&nbsp;Create Statistic</h2>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                @elseif(session('unsuccessful'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('unsuccessful') }}
                    </div>
                @endif
                <table class="table table-borderless" style="width:100%;">
                    <tr>
                        <form action = "{{ route('statistic.store') }}" method="post">
                            @csrf
                            <th scope="col" style="width:10%">Year</th>
                            <td>
                                <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year') }}">
                                @error('year')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:10%">Data</th>
                        <td><input type="number" name="data" class="form-control @error('data') is-invalid @enderror" value="{{ old('data') }}">
                            @error('data')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th class="borderless" colspan="2" style="text-align: right; border: none !important;"><button type="submit" class="btn btn-dark">UPDATE</button>&nbsp;&nbsp;<button type="reset" class="btn btn-warning">RESET</button></th>
                        </form>
                    </tr>
                    <tbody>
                    </tbody>
                </table>
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



